<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LicenseController;
use App\Services\Statistics\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use App\Models\SubscriptionPlan;
use App\Models\Code;
use App\Models\User;
use App\Models\ApiKey;


class CodeController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new LicenseController();
    }

    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        return view('user.codex.index');
    }


    /**
	*
	* Process Davinci Code
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

            $verify = $this->api->verify_license();
            if($verify['status']!=true){return false;}

            # Check if user has access to the template
            if (auth()->user()->group == 'user') {
                if (config('settings.code_feature_user') != 'allow') {
                    $data['status'] = 'error';
                    $data['message'] = __('AI Code feature is not available for your account, subscribe to get access');
                    return $data;
                } 

            } elseif (!is_null(auth()->user()->group)) {
                $plan = SubscriptionPlan::where('id', auth()->user()->plan_id)->first();
                if ($plan) {
                    if (!$plan->code_feature) {
                        $data['status'] = 'error';
                        $data['message'] = __('AI Code feature is not available for your subscription plan');
                        return $data;
    
                    }
                }
            }   
            
            # Verify if user has enough credits
            if ((auth()->user()->available_words + auth()->user()->available_words_prepaid) < 50) {
                if (!is_null(auth()->user()->member_of)) {
                    if (auth()->user()->member_use_credits_code) {
                        $member = User::where('id', auth()->user()->member_of)->first();
                        if (($member->available_words + $member->available_words_prepaid) < 50) {
                            $data['status'] = 'error';
                            $data['message'] = __('Not enough word balance to proceed, subscribe or top up your word balance and try again');
                            return $data;
                        }
                    } else {
                        $data['status'] = 'error';
                        $data['message'] = __('Not enough word balance to proceed, subscribe or top up your word balance and try again');
                        return $data;
                    }
                    
                } else {
                    $data['status'] = 'error';
                    $data['message'] = __('Not enough word balance to proceed, subscribe or top up your word balance and try again');
                    return $data;
                } 
            }

            if ($request->language != 'html' || $request->language == 'none') {
                $prompt = "You are a helpful assistant that writes code. Write a good code in " . $request->language . ' programming language';
            } elseif ($request->language == 'html') {
                $prompt = "You are a helpful assistant that writes html code.";
            } else {
                $prompt = "You are a helpful assistant that writes code.";
            }
           

            $complete = $open_ai->chat([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        "role" => "system",
                        "content" => $prompt,
                    ],
                    [
                        "role" => "user",
                        "content" => $request->instructions,
                    ],
                ],
                'temperature' => 1,
                'max_tokens' => 3500,
            ]);

            $response = json_decode($complete , true);
            $uploading = new UserService();
            $upload = $uploading->upload();
            if (!$upload['status']) return;  

            if (isset($response['choices'])) {

                $text = $response['choices'][0]['message']['content'];
                $tokens = $response['usage']['total_tokens'];

                # Update credit balance
                $this->updateBalance($tokens);
                
                $code = new Code();
                $code->user_id = auth()->user()->id;
                $code->model = $request->language;
                $code->instructions = $request->instructions;
                $code->save();

                $data['text'] = $text;
                $data['status'] = 'success';
                $data['id'] = $code->id;
                $data['old'] = auth()->user()->available_words + auth()->user()->available_words_prepaid;
                $data['current'] = auth()->user()->available_words + auth()->user()->available_words_prepaid - $tokens;
                return $data; 

            } else {

                if (isset($response['error']['message'])) {
                    $message = $response['error']['message'];
                } else {
                    $message = __('There is an issue with your openai account');
                }

                $data['status'] = 'error';
                $data['message'] = $message;
                return $data;
            }
           
        }
	}


    /**
	*
	* Update user word balance
	* @param - total words generated
	* @return - confirmation
	*
	*/
    public function updateBalance($words) {

        $uploading = new UserService();
        $upload = $uploading->upload();
        if (!$upload['status']) return;  

        $user = User::find(Auth::user()->id);

        if (Auth::user()->available_words > $words) {

            $total_words = Auth::user()->available_words - $words;
            $user->available_words = ($total_words < 0) ? 0 : $total_words;

        } elseif (Auth::user()->available_words_prepaid > $words) {

            $total_words_prepaid = Auth::user()->available_words_prepaid - $words;
            $user->available_words_prepaid = ($total_words_prepaid < 0) ? 0 : $total_words_prepaid;

        } elseif ((Auth::user()->available_words + Auth::user()->available_words_prepaid) == $words) {

            $user->available_words = 0;
            $user->available_words_prepaid = 0;

        } else {

            if (!is_null(Auth::user()->member_of)) {

                $member = User::where('id', Auth::user()->member_of)->first();

                if ($member->available_words > $words) {

                    $total_words = $member->available_words - $words;
                    $member->available_words = ($total_words < 0) ? 0 : $total_words;
        
                } elseif ($member->available_words_prepaid > $words) {
        
                    $total_words_prepaid = $member->available_words_prepaid - $words;
                    $member->available_words_prepaid = ($total_words_prepaid < 0) ? 0 : $total_words_prepaid;
        
                } elseif (($member->available_words + $member->available_words_prepaid) == $words) {
        
                    $member->available_words = 0;
                    $member->available_words_prepaid = 0;
        
                } else {
                    $remaining = $words - $member->available_words;
                    $member->available_words = 0;
    
                    $prepaid_left = $member->available_words_prepaid - $remaining;
                    $member->available_words_prepaid = ($prepaid_left < 0) ? 0 : $prepaid_left;
                }

                $member->update();

            } else {
                $remaining = $words - Auth::user()->available_words;
                $user->available_words = 0;

                $prepaid_left = Auth::user()->available_words_prepaid - $remaining;
                $user->available_words_prepaid = ($prepaid_left < 0) ? 0 : $prepaid_left;
            }

        }

        $user->update();

        return true;
    }


    /**
	*
	* Save changes
	* @param - file id in DB
	* @return - confirmation
	*
	*/
	public function save(Request $request) 
    {
        if ($request->ajax()) {

            $verify = $this->api->verify_license();
            if($verify['status']!=true){return false;}

            $document = Code::where('id', request('id'))->first(); 

            if ($document->user_id == Auth::user()->id){

                $document->code = $request->text;
                $document->title = $request->title;
                $document->save();

                $data['status'] = 'success';
                return $data;  
    
            } else{

                $data['status'] = 'error';
                return $data;
            }  
        }
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

            $verify = $this->api->verify_license();
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

            $verify = $this->api->verify_license();
            if($verify['status']!=true){return false;}

            $image = Image::where('id', request('id'))->first(); 

            if ($image->user_id == auth()->user()->id){

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
