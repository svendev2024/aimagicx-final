<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LicenseController;
use App\Services\Statistics\UserService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use App\Models\SubscriptionPlan;
use App\Models\Image;
use App\Models\User;
use App\Models\ApiKey;
use App\Services\Service;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ImageController extends Controller
{
    private $api;
    private $user;

    public function __construct()
    {
        $this->api = new LicenseController();
        $this->user = new UserService();
    }

    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $data = Image::where('user_id', Auth::user()->id)->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                            <a download href=" '. url($row["image"]) .'"><i class="fa-solid fa-cloud-arrow-down table-action-buttons edit-action-button" title="Download Image"></i></a>
                                            <a class="deleteResultButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Image"></i></a> 
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span class="font-weight-bold">'.date_format($row["created_at"], 'd M Y').'</span><br><span>'.date_format($row["created_at"], 'H:i A').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-image', function($row){
                        if ($row['storage'] == 'local' || is_null($row['storage'])) {
                            $path = URL::asset($row['image']);
                        } else {
                            $path = $row['image'];
                        }
                        
                        $user = '<div class="d-flex">
                                <div class="widget-user-image-sm ai-image-special overflow-hidden mr-4"><a class="file-name font-weight-bold" href="#" id="'.$row["id"].'"><img alt="Avatar" src="' . $path . '"></a></div>
                                <div class="pt-1"><a class="file-name font-weight-bold" href="#" id="'.$row["id"].'">' . $row['name'] . '</a><br><span class="text-muted">'.$row["description"].'</span></div>
                            </div>';                        
                        return $user;
                    })
                    ->rawColumns(['actions', 'created-on', 'custom-image'])
                    ->make(true);
                    
        }

        return view('user.images.index');
    }


    /**
	*
	* Process Davinci Image
	* @param - file id in DB
	* @return - confirmation
	*
	*/
	public function process(Request $request) 
    {
        if ($request->ajax()) {

            if (config('settings.openai_key_usage') == 'main') {
                $open_ai = new OpenAi(config('services.openai.key'));
            } else {
                $api_keys = ApiKey::where('engine', 'openai')->where('status', true)->pluck('api_key')->toArray();
                array_push($api_keys, config('services.openai.key'));
                $key = array_rand($api_keys, 1);
                $open_ai = new OpenAi($api_keys[$key]);
            }

            $verify = $this->user->verify_license();
            if($verify['status']!=true){return false;}

            $plan = SubscriptionPlan::where('id', auth()->user()->plan_id)->first();

            # Check if user has access to the template
            if (auth()->user()->group == 'user') {
                if (config('settings.image_feature_user') != 'allow') {
                    $data['status'] = 'error';
                    $data['message'] = __('AI Image feature is not available for your account, subscribe to get access');
                    return $data;
                }
            } elseif (!is_null(auth()->user()->group)) {
                if ($plan) {
                    if (!$plan->image_feature) {
                        $data['status'] = 'error';
                        $data['message'] = __('AI Image feature is not available for your subscription plan');
                        return $data;
    
                    }
                }
            }             

            # Verify if user has enough credits
            if ((auth()->user()->available_images + auth()->user()->available_images_prepaid) < $request->max_results) {
                if (!is_null(auth()->user()->member_of)) {
                    if (auth()->user()->member_use_credits_image) {
                        $member = User::where('id', auth()->user()->member_of)->first();
                        if (($member->available_images + $member->available_images_prepaid) < $request->max_results) {
                            $data['status'] = 'error';
                            $data['message'] = __('Not enough image balance to proceed, subscribe or top up your image balance and try again');
                            return $data;
                        }
                    } else {
                        $data['status'] = 'error';
                        $data['message'] = __('Not enough image balance to proceed, subscribe or top up your image balance and try again');
                        return $data;
                    }
                    
                } else {
                    $data['status'] = 'error';
                    $data['message'] = __('Not enough image balance to proceed, subscribe or top up your image balance and try again');
                    return $data;
                } 
            }


            $max_results = (int)$request->max_results;
            $plan_type = (auth()->user()->plan_id) ? 'paid' : 'free';  

            $prompt = $request->title;
            
            if ($request->style != 'none') {
                $prompt .= ', ' . $request->style; 
            } 
            
            if ($request->lightning != 'none') {
                $prompt .= ', ' . $request->lightning; 
            } 
            
            if ($request->artist != 'none') {
                $prompt .= ', ' . $request->artist; 
            }
            
            if ($request->medium != 'none') {
                $prompt .= ', ' . $request->medium; 
            }
            
            if ($request->mood != 'none') {
                $prompt .= ', ' . $request->mood; 
            }


            if (config('settings.image_vendor') == 'openai') {
            
                $complete = $open_ai->image([
                    'prompt' => $prompt,
                    'size' => $request->resolution,
                    'n' => $max_results,
                    "response_format" => "url",
                ]);

                $upload = new Service();
                $status = $upload->upload();
                if($status['status']!=true){return false;}

                $response = json_decode($complete , true);

                if (isset($response['data'])) {
                    if (count($response['data']) > 1) {
                        foreach ($response['data'] as $key => $value) {
                            $url = $value['url'];

                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            $contents = curl_exec($curl);
                            curl_close($curl);

                            $name = Str::random(10) . '.png';

                            if (config('settings.default_storage') == 'local') {
                                Storage::disk('local')->put('images/' . $name, $contents);
                                $image_url = 'images/' . $name;
                                $storage = 'local';
                            } elseif (config('settings.default_storage') == 'aws') {
                                Storage::disk('s3')->put('images/' . $name, $contents, 'public');
                                $image_url = Storage::disk('s3')->url('images/' . $name);
                                $storage = 'aws';
                            } elseif (config('settings.default_storage') == 'wasabi') {
                                Storage::disk('wasabi')->put('images/' . $name, $contents);
                                $image_url = Storage::disk('wasabi')->url('images/' . $name);
                                $storage = 'wasabi';
                            }

                            if ($plan) {
                                if (is_null($plan->image_storage_days)) {
                                    if (config('settings.default_duration') == 0) {
                                        $expiration = Carbon::now()->addDays(18250);
                                    } else {
                                        $expiration = Carbon::now()->addDays(config('settings.default_duration'));
                                    }                            
                                } else {
                                    if ($plan->image_storage_days == 0) {
                                        $expiration = Carbon::now()->addDays(18250);
                                    } else {
                                        $expiration = Carbon::now()->addDays($plan->image_storage_days);
                                    }
                                }
                            } else {
                                if (config('settings.default_duration') == 0) {
                                    $expiration = Carbon::now()->addDays(18250);
                                } else {
                                    $expiration = Carbon::now()->addDays(config('settings.default_duration'));
                                } 
                            }

                            $content = new Image();
                            $content->user_id = auth()->user()->id;
                            $content->name = $request->name . '-' . $key;
                            $content->description = $request->title;
                            $content->resolution = $request->resolution;
                            $content->image = $image_url;
                            $content->plan_type = $plan_type;
                            $content->storage = $storage;
                            $content->expires_at = $expiration;
                            $content->image_name = 'images/' . $name;
                            $content->save();
                        }
                    } else {
                        $url = $response['data'][0]['url'];

                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_URL, $url);
                        $contents = curl_exec($curl);
                        curl_close($curl);


                        $name = Str::random(10) . '.png';

                        if (config('settings.default_storage') == 'local') {
                            Storage::disk('local')->put('images/' . $name, $contents);
                            $image_url = 'images/' . $name;
                            $storage = 'local';
                        } elseif (config('settings.default_storage') == 'aws') {
                            Storage::disk('s3')->put('images/' . $name, $contents, 'public');
                            $image_url = Storage::disk('s3')->url('images/' . $name);
                            $storage = 'aws';
                        } elseif (config('settings.default_storage') == 'wasabi') {
                            Storage::disk('wasabi')->put('images/' . $name, $contents);
                            $image_url = Storage::disk('wasabi')->url('images/' . $name);
                            $storage = 'wasabi';
                        }

                        if ($plan) {
                            if (is_null($plan->image_storage_days)) {
                                if (config('settings.default_duration') == 0) {
                                    $expiration = Carbon::now()->addDays(18250);
                                } else {
                                    $expiration = Carbon::now()->addDays(config('settings.default_duration'));
                                }                            
                            } else {
                                if ($plan->image_storage_days == 0) {
                                    $expiration = Carbon::now()->addDays(18250);
                                } else {
                                    $expiration = Carbon::now()->addDays($plan->image_storage_days);
                                }
                            }
                        } else {
                            if (config('settings.default_duration') == 0) {
                                $expiration = Carbon::now()->addDays(18250);
                            } else {
                                $expiration = Carbon::now()->addDays(config('settings.default_duration'));
                            } 
                        }

                        $content = new Image();
                        $content->user_id = auth()->user()->id;
                        $content->name = $request->name;
                        $content->description = $request->title;
                        $content->resolution = $request->resolution;
                        $content->image = $image_url;
                        $content->plan_type = $plan_type;
                        $content->storage = $storage;
                        $content->expires_at = $expiration;
                        $content->image_name = 'images/' . $name;
                        $content->save();
                    }
                    
                    # Update credit balance
                    $this->updateBalance($max_results);

                    $data['status'] = 'success';
                    $data['old'] = auth()->user()->available_images + auth()->user()->available_images_prepaid;
                    $data['current'] = auth()->user()->available_images + auth()->user()->available_images_prepaid - $max_results;
                    return $data; 

                } else {

                    $message = $response['error']['message'];

                    $data['status'] = 'error';
                    $data['message'] = $message;
                    return $data;
                }

            } elseif (config('settings.image_vendor') == 'stable_diffusion') {

                $url = 'https://api.stability.ai/v1/generation/' . config('settings.image_stable_diffusion_engine') . '/text-to-image';

                if (config('settings.sd_key_usage') == 'main') {
                    $stable_diffusion = config('services.stable_diffusion.key');
                } else {
                    $api_keys = ApiKey::where('engine', 'stable_diffusion')->where('status', true)->pluck('api_key')->toArray();
                    array_push($api_keys, config('services.stable_diffusion.key'));
                    $key = array_rand($api_keys, 1);
                    $stable_diffusion = $api_keys[$key];
                }

                $headers = [
                            'Authorization:' . $stable_diffusion, 
                            'Content-Type: application/json',
                        ];

                $resolutions = explode('x', $request->resolution);
                $width = $resolutions[0];
                $height = $resolutions[1];
 
                $data['text_prompts'][0]['text'] = $prompt;
                $data['text_prompts'][0]['weight'] = 1;
                $data['clip_guidance_preset'] = $request->preset;
                $data['height'] = (int)$height;
                $data['width'] = (int)$width; 
                if ($request->diffusion_samples != 'none') {
                    $data['sampler'] = $request->diffusion_samples;
                }
                $data['samples'] = $max_results;
                if ($request->style != 'none') {
                    $data['style_preset'] = $request->style;
                }

                $upload = new Service();
                $status = $upload->upload();
                if($status['status']!=true){return false;}

                $postdata = json_encode($data);

                $ch = curl_init($url); 
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $result = curl_exec($ch);
                curl_close($ch);

                $response = json_decode($result , true);

                if (isset($response['artifacts'])) {
                    foreach ($response['artifacts'] as $key => $value) {

                        $image = base64_decode($value['base64']);

                        $name = Str::random(10) . '.png';

                        if (config('settings.default_storage') == 'local') {
                            Storage::disk('local')->put('images/' . $name, $image);
                            $image_url = 'images/' . $name;
                            $storage = 'local';
                        } elseif (config('settings.default_storage') == 'aws') {
                            Storage::disk('s3')->put('images/' . $name, $image, 'public');
                            $image_url = Storage::disk('s3')->url('images/' . $name);
                            $storage = 'aws';
                        } elseif (config('settings.default_storage') == 'wasabi') {
                            Storage::disk('wasabi')->put('images/' . $name, $image);
                            $image_url = Storage::disk('wasabi')->url('images/' . $name);
                            $storage = 'wasabi';
                        }

                        if ($plan) {
                            if (is_null($plan->image_storage_days)) {
                                if (config('settings.default_duration') == 0) {
                                    $expiration = Carbon::now()->addDays(18250);
                                } else {
                                    $expiration = Carbon::now()->addDays(config('settings.default_duration'));
                                }                            
                            } else {
                                if ($plan->image_storage_days == 0) {
                                    $expiration = Carbon::now()->addDays(18250);
                                } else {
                                    $expiration = Carbon::now()->addDays($plan->image_storage_days);
                                }
                            }
                        } else {
                            if (config('settings.default_duration') == 0) {
                                $expiration = Carbon::now()->addDays(18250);
                            } else {
                                $expiration = Carbon::now()->addDays(config('settings.default_duration'));
                            } 
                        }

                        $content = new Image();
                        $content->user_id = auth()->user()->id;
                        $content->name = $request->name;
                        $content->description = $request->title;
                        $content->resolution = $request->resolution;
                        $content->image = $image_url;
                        $content->plan_type = $plan_type;
                        $content->storage = $storage;
                        $content->expires_at = $expiration;
                        $content->image_name = 'images/' . $name;
                        $content->save();

                    }

                    # Update credit balance
                    $this->updateBalance($max_results);

                    $data['status'] = 'success';
                    $data['old'] = auth()->user()->available_images + auth()->user()->available_images_prepaid;
                    $data['current'] = auth()->user()->available_images + auth()->user()->available_images_prepaid - $max_results;
                    return $data; 

                } else {

                    $data['status'] = 'error';
                    $data['message'] = __('There was an issue generating your AI Image, please try again or contact support team');
                    return $data;
                }

            }
           

        }
	}


    /**
	*
	* Update user image balance
	* @param - total words generated
	* @return - confirmation
	*
	*/
    public function updateBalance($images) {

        $user = User::find(Auth::user()->id);

        if (Auth::user()->available_words > $images) {

            $total_images = Auth::user()->available_images - $images;
            $user->available_images = ($total_images < 0) ? 0 : $total_images;

        } elseif (Auth::user()->available_images_prepaid > $images) {

            $total_images_prepaid = Auth::user()->available_images_prepaid - $images;
            $user->available_images_prepaid = ($total_images_prepaid < 0) ? 0 : $total_images_prepaid;

        } elseif ((Auth::user()->available_images + Auth::user()->available_images_prepaid) == $images) {

            $user->available_images = 0;
            $user->available_images_prepaid = 0;

        } else {

            if (!is_null(Auth::user()->member_of)) {

                $member = User::where('id', Auth::user()->member_of)->first();

                if ($member->available_images > $images) {

                    $total_images = $member->available_images - $images;
                    $member->available_images = ($total_images < 0) ? 0 : $total_images;
        
                } elseif ($member->available_images_prepaid > $images) {
        
                    $total_images_prepaid = $member->available_images_prepaid - $images;
                    $member->available_images_prepaid = ($total_images_prepaid < 0) ? 0 : $total_images_prepaid;
        
                } elseif (($member->available_images + $member->available_images_prepaid) == $images) {
        
                    $member->available_images = 0;
                    $member->available_images_prepaid = 0;
        
                } else {
                    $remaining = $images - $member->available_images;
                    $member->available_images = 0;
    
                    $prepaid_left = $member->available_images_prepaid - $remaining;
                    $member->available_images_prepaid = ($prepaid_left < 0) ? 0 : $prepaid_left;
                }

                $member->update();

            } else {
                $remaining = $images - Auth::user()->available_images;
                $user->available_images = 0;

                $prepaid_left = Auth::user()->available_images_prepaid - $remaining;
                $user->available_images_prepaid = ($prepaid_left < 0) ? 0 : $prepaid_left;
            }

        }

        $user->update();

    }


     /**
	*
	* Process media file
	* @param - file id in DB
	* @return - confirmation
	*
	*/
	public function view(Request $request) 
    {
        if ($request->ajax()) {

            $verify = $this->user->verify_license();
            if($verify['status']!=true){return false;}

            $image = Image::where('id', request('id'))->first(); 

            if ($image) {
                if ($image->user_id == Auth::user()->id){

                    $data['status'] = 'success';
                    $data['url'] = URL::asset($image->image);
                    return $data;  
        
                } else{
    
                    $data['status'] = 'error';
                    $data['message'] = __('There was an error while retrieving this image');
                    return $data;
                }  
            } else {
                $data['status'] = 'error';
                $data['message'] = __('Image was not found');
                return $data;
            }
            
        }
	}


    /**
	*
	* Delete File
	* @param - file id in DB
	* @return - confirmation
	*
	*/
	public function delete(Request $request) 
    {
        if ($request->ajax()) {

            $verify = $this->user->verify_license();
            if($verify['status']!=true){return false;}

            $image = Image::where('id', request('id'))->first(); 

            if ($image->user_id == auth()->user()->id){

                switch ($image->storage) {
                    case 'local':
                        if (Storage::exists($image->image)) {
                            Storage::delete($image->image);
                        }
                        break;
                    case 'aws':
                        if (Storage::disk('s3')->exists($image->image_name)) {
                            Storage::disk('s3')->delete($image->image_name);
                        }
                        break;
                    case 'wasabi':
                        if (Storage::disk('wasabi')->exists($image->image_name)) {
                            Storage::disk('wasabi')->delete($image->image_name);
                        }
                        break;
                    default:
                        # code...
                        break;
                }

                $image->delete();

                $data['status'] = 'success';
                return $data;  
    
            } else{

                $data['status'] = 'error';
                $data['message'] = __('There was an error while deleting the image');
                return $data;
            }  
        }
	}

}
