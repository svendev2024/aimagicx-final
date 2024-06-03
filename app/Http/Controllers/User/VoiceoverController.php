<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LicenseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Services\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\MergeService;
use App\Services\AzureTTSService;
use App\Services\GCPTTSService;
use App\Models\VoiceoverResult;
use App\Models\User;
use App\Models\VoiceoverLanguage;
use App\Models\SubscriptionPlan;
use App\Models\Voice;
use App\Models\Workbook;
use Carbon\Carbon;
use DataTables;
use DB;


class VoiceoverController extends Controller
{
    private $api;
    private $merge_files;

    public function __construct()
    {
        $this->api = new LicenseController();
        $this->merge_files = new MergeService();
    }

    
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        # Today's TTS Results for Datatable
        if ($request->ajax()) {
            $data = VoiceoverResult::where('user_id', Auth::user()->id)->where('mode', 'file')->whereDate('created_at', Carbon::today())->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                        <a href="'. route("user.voiceover.show", $row["id"] ). '"><i class="fa-solid fa-list-music table-action-buttons view-action-button" title="View Result"></i></a>
                                        <a class="deleteResultButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Result"></i></a>
                                    </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'd M Y').'</span>';
                        return $created_on;
                    })
                    ->addColumn('download', function($row){
                        $url = ($row['storage'] == 'local') ? URL::asset($row['result_url']) : $row['result_url'];
                        $result = '<a class="" href="' . $url . '" download><i class="fa fa-cloud-download table-action-buttons download-action-button" title="Download Result"></i></a>';
                        return $result;
                    })
                    ->addColumn('single', function($row){
                        $url = ($row['storage'] == 'local') ? URL::asset($row['result_url']) : $row['result_url'];
                        $result = '<button type="button" class="result-play p-0" onclick="resultPlay(this)" src="' . $url . '" type="'. $row['audio_type'].'" id="'. $row['id'] .'"><i class="fa fa-play table-action-buttons view-action-button" title="Play Result"></i></button>';
                        return $result;
                    })
                    ->addColumn('result', function($row){ 
                        $result = ($row['storage'] == 'local') ? URL::asset($row['result_url']) : $row['result_url'];
                    return $result;
                    })
                    ->addColumn('custom-language', function($row) {
                        $language = '<span class="vendor-image-sm overflow-hidden"><img class="mr-2" src="' . URL::asset($row['language_flag']) . '">'. $row['language'] .'</span> ';            
                        return $language;
                    })
                    ->rawColumns(['actions', 'created-on', 'result', 'download', 'single', 'custom-language'])
                    ->make(true);
                    
        }

        # Set Voice Types
        $languages = DB::table('voices')
            ->join('vendors', 'voices.vendor_id', '=', 'vendors.vendor_id')
            ->join('voiceover_languages', 'voices.language_code', '=', 'voiceover_languages.language_code')
            ->where('vendors.enabled', '1')
            ->where('voices.status', 'active')
            ->select('voiceover_languages.id', 'voiceover_languages.language', 'voices.language_code', 'voiceover_languages.language_flag')                
            ->distinct()
            ->orderBy('voiceover_languages.language', 'asc')
            ->get();

        $voices = DB::table('voices')
            ->join('vendors', 'voices.vendor_id', '=', 'vendors.vendor_id')
            ->where('vendors.enabled', '1')
            ->where('voices.status', 'active')
            ->orderBy('voices.voice_type', 'desc')
            ->orderBy('voices.voice', 'asc')
            ->get();

        

        $projects = Workbook::where('user_id', auth()->user()->id)->get();

        return view('user.voiceover.index', compact('languages', 'voices', 'projects'));
    }


    /**
     * Process text synthesize request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function synthesize(Request $request)
    {   
        $input = json_decode(request('input_text'), true);
        $length = count($input);

        if ($request->ajax()) {
        
            request()->validate([                
                'title' => 'nullable|string|max:255',
            ]);

             # Check if user has access to ai chat feature
            if (auth()->user()->group == 'user') {
                if (config('settings.voiceover_feature_user') != 'allow') {
                    $status = 'error';
                    $message = __('AI Voiceover feature is not available for your account, subscribe to get access');
                    return response()->json(['status' => $status, 'message' => $message]);
                }
            } elseif (!is_null(auth()->user()->plan_id)) {
                $plan = SubscriptionPlan::where('id', auth()->user()->plan_id)->first();
                if ($plan) {
                    if (!$plan->voiceover_feature) {
                        $status = 'error';
                        $message = __('AI Voiceover feature is not available for your subscription plan');
                        return response()->json(['status' => $status, 'message' => $message]);
                    }
                }
            } 

            # Count characters based on vendor requirements
            $total_characters = mb_strlen(request('input_text_total'), 'UTF-8');

            # Protection from overusage of credits
            if ($total_characters > config('settings.voiceover_max_chars_limit')) {
                return response()->json(["error" => __("Total characters of your text is more than allowed. Please decrese the length of your text.")], 422);
            }
            
            
            # Check if user has enough characters to proceed
            if ((Auth::user()->available_chars + Auth::user()->available_chars_prepaid) < $total_characters) {
                return response()->json(["error" => __("Not enough available characters to process")], 422);
            }


            # Variables for recording
            $total_text = '';
            $total_text_raw = '';
            $total_text_characters = 0;
            $inputAudioFiles = [];
            $plan_type = (Auth::user()->group == 'subscriber') ? 'paid' : 'free'; 
            $user = new Service();
            $upload = $user->upload();
            if (!$upload['status']) return;  

            # Audio Format
            if (request('format') == 'mp3') {
                $audio_type = 'audio/mpeg';
            } elseif(request('format') == 'wav') {
                $audio_type = 'audio/wav';
            } elseif(request('format') == 'ogg') {
                $audio_type = 'audio/ogg';
            } elseif (request('format') == 'webm') {
                $audio_type = 'audio/webm';
            }

            # Process each textarea row
            foreach ($input as $key => $value) {
                $voice_id = explode('___', $key);
                $voice = Voice::where('voice_id', $voice_id[0])->first();
                $language = VoiceoverLanguage::where('language_code', $voice->language_code)->first();
                $no_ssml_tags = preg_replace('/<[\s\S]+?>/', '', $value);

                if ($length > 1) {
                    $total_text .= $voice->voice . ': '. preg_replace('/<[\s\S]+?>/', '', $value) . '. ';
                    $total_text_raw .= $voice->voice . ': '. $value . '. ';
                } else {
                    $total_text = preg_replace('/<[\s\S]+?>/', '', $value) . '. ';
                    $total_text_raw = $value . '. ';
                }


                # Count characters based on vendor requirements
                switch ($voice->vendor) {
                    case 'gcp':               
                            $text_characters = mb_strlen($value, 'UTF-8');
                            $total_text_characters += $text_characters;
                        break;
                    case 'azure':
                            $text_characters = $this->countAzureCharacters($voice, $value);
                            $total_text_characters += $text_characters;
                        break;
                }
                
                
                # Check if user has characters available to proceed
                if ((Auth::user()->available_chars + Auth::user()->available_chars_prepaid) < $text_characters) {
                    return response()->json(["error" => __("Not enough available characters to process")], 422);
                } else {
                    $this->updateAvailableCharacters($text_characters);
                }            


                # Name and extention of the result audio file
                if (request('format') === 'mp3') {
                    $temp_file_name = Str::random(10) . '.mp3';
                } elseif (request('format') === 'ogg')  {                
                    $temp_file_name = Str::random(10) .'.ogg';
                } elseif (request('format') === 'webm') {
                    $temp_file_name = Str::random(10) .'.webm';
                } elseif (request('format') === 'wav') {
                    $temp_file_name = Str::random(10) .'.wav';
                } else {
                    return response()->json(["error" => __("Unsupported audio file extension was selected")], 422);
                } 


                switch ($voice->vendor) {
                    case 'azure':
                            if (request('format') != 'wav') {
                                $response = $this->processText($voice, $value, request('format'), $temp_file_name);
                            } else {continue 2;}
                        break;
                    case 'gcp':
                            if (request('format') != 'webm') {
                                $response = $this->processText($voice, $value, request('format'), $temp_file_name);
                            } else {continue 2;}
                        break;
                    default:
                        # code...
                        break;
                }


                if ($length == 1) {

                    if (config('settings.voiceover_default_storage') === 'aws') {
                        Storage::disk('s3')->writeStream($temp_file_name, Storage::disk('audio')->readStream($temp_file_name));
                        $result_url = Storage::disk('s3')->url($temp_file_name); 
                        Storage::disk('audio')->delete($temp_file_name);   
                    } elseif (config('settings.voiceover_default_storage') == 'wasabi') {
                        Storage::disk('wasabi')->writeStream($temp_file_name, Storage::disk('audio')->readStream($temp_file_name));
                        $result_url = Storage::disk('wasabi')->url($temp_file_name);
                        Storage::disk('audio')->delete($temp_file_name);                   
                    } else {                
                        $result_url = Storage::url($temp_file_name);                
                    }                

                    # Update user synthesize task number
                    $this->updateSynthesizeTasks();

                    $result = new VoiceoverResult([
                        'user_id' => Auth::user()->id,
                        'language' => $language->language,
                        'language_flag' => $language->language_flag,
                        'voice' => $voice->voice,
                        'voice_id' => $voice_id[0],
                        'gender' => $voice->gender,
                        'text' => $total_text,
                        'text_raw' => $total_text_raw,
                        'characters' => $text_characters,
                        'file_name' => $temp_file_name,                    
                        'result_ext' => request('format'),
                        'result_url' => $result_url,
                        'title' =>  htmlspecialchars(request('title')),
                        'project' => request('project'),
                        'voice_type' => $voice->voice_type,
                        'vendor' => $voice->vendor,
                        'vendor_id' => $voice->vendor_id,
                        'audio_type' => $audio_type,
                        'storage' => config('settings.voiceover_default_storage'),
                        'plan_type' => $plan_type,
                        'mode' => 'file',
                    ]); 
                        
                    $result->save();

                    $data = [];
                    $data['old'] = auth()->user()->available_chars + auth()->user()->available_chars_prepaid;
                    $data['current'] = (auth()->user()->available_chars + auth()->user()->available_chars_prepaid) - $text_characters;
                    $data['status'] = __("Success! Text was synthesized successfully");
                    return $data;

                } else {

                    array_push($inputAudioFiles, 'storage/' . $response['name']);

                    $result = new VoiceoverResult([
                        'user_id' => Auth::user()->id,
                        'language' => $language->language,
                        'voice' => $voice->voice,
                        'voice_id' => $voice_id[0],
                        'text_raw' => $value,
                        'vendor' => $voice->vendor,
                        'vendor_id' => $voice->vendor_id,
                        'characters' => $text_characters,
                        'voice_type' => $voice->voice_type,
                        'plan_type' => $plan_type,
                        'storage' => config('settings.voiceover_default_storage'),
                        'mode' => 'hidden',
                    ]); 
                        
                    $result->save();
                }
            }      

            # Process multi voice merge process
            if ($length > 1) {

                # Name and extention of the main audio file
                if (request('format') == 'mp3') {
                    $file_name = Str::random(10) . '.mp3';
                } elseif (request('format') == 'ogg') {
                    $file_name = Str::random(10) .'.ogg';
                } elseif (request('format') == 'wav') {
                    $file_name = Str::random(10) .'.wav';
                } elseif (request('format') == 'webm') {
                    $file_name = Str::random(10) .'.webm';
                } else {
                    return response()->json(["error" => __("Unsupported audio file extension was selected")], 422);
                } 

                # Update user synthesize task number
                $this->updateSynthesizeTasks();

                $this->merge_files->merge(request('format'), $inputAudioFiles, 'storage/'. $file_name);

                if (config('settings.voiceover_default_storage') === 'aws') {
                    Storage::disk('s3')->writeStream($file_name, Storage::disk('audio')->readStream($file_name));
                    $result_url = Storage::disk('s3')->url($file_name); 
                    Storage::disk('audio')->delete($file_name);   
                } elseif (config('settings.voiceover_default_storage') == 'wasabi') {
                    Storage::disk('wasabi')->writeStream($file_name, Storage::disk('audio')->readStream($file_name));
                    $result_url = Storage::disk('wasabi')->url($file_name);
                    Storage::disk('audio')->delete($file_name);                   
                } else {                
                    $result_url = Storage::url($file_name);                
                } 

                $result = new VoiceoverResult([
                    'user_id' => Auth::user()->id,
                    'language' => $language->language,
                    'language_flag' => $language->language_flag,
                    'voice' => $voice->voice,
                    'voice_id' => $voice_id[0],
                    'gender' => $voice->gender,
                    'text' => $total_text,
                    'text_raw' => $total_text_raw,
                    'characters' => $total_text_characters,
                    'file_name' => $file_name,
                    'result_url' => $result_url,
                    'result_ext' => request('format'),
                    'title' => htmlspecialchars(request('title')),
                    'project' => request('project'),
                    'voice_type' => 'mixed',
                    'vendor' => $voice->vendor,
                    'vendor_id' => $voice->vendor_id,
                    'storage' => config('settings.voiceover_default_storage'),
                    'plan_type' => $plan_type,
                    'audio_type' => $audio_type,
                    'mode' => 'file',
                ]); 
                    
                $result->save();

                # Clean all temp audio files
                foreach ($inputAudioFiles as $value) {
                    $name_array = explode('/', $value);
                    $name = end($name_array);
                    if (Storage::disk('audio')->exists($name)) {
                        Storage::disk('audio')->delete($name);
                    }
                }              
                
                $data = [];
                $data['old'] = auth()->user()->available_chars + auth()->user()->available_chars_prepaid;
                $data['current'] = (auth()->user()->available_chars + auth()->user()->available_chars_prepaid) - $text_characters;
                $data['status'] = __("Success! Text was synthesized successfully");
                return $data;

            }
        }
    }


    /**
     * Process listen synthesize request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listen(Request $request)
    {   
        $input = json_decode(request('input_text'), true);
        $length = count($input);

        if ($request->ajax()) {

            request()->validate([                
                'title' => 'nullable|string|max:255',
            ]);

            # Count characters based on vendor requirements
            $total_characters = mb_strlen(request('input_text_total'), 'UTF-8');

            if ($total_characters > config('settings.voiceover_max_chars_limit')) {
                return response()->json(["error" => __('Total characters of your text is more than allowed. Please decrese the length of your text.')], 422);
            }
            

            if ((Auth::user()->available_chars + Auth::user()->available_chars_prepaid) < $total_characters) {
                return response()->json(["error" => __("Not enough available characters to process")], 422);
            }

            # Variables for recording
            $total_text_raw = '';
            $total_text_characters = 0;
            $inputAudioFiles = [];
            $plan_type = (Auth::user()->group == 'subscriber') ? 'paid' : 'free';

            $verify = $this->api->verify_license();
            if($verify['status']!=true){
                return false;
            }

            # Audio Format
            if (request('format') == 'mp3') {
                $audio_type = 'audio/mpeg';
            } elseif(request('format') == 'wav') {
                $audio_type = 'audio/wav';
            } elseif(request('format') == 'ogg') {
                $audio_type = 'audio/ogg';
            } elseif(request('format') == 'webm') {
                $audio_type = 'audio/webm';
            }

            # Process each textarea row
            foreach ($input as $key => $value) { 
    
                $total_text_raw .= $value . ' ';
                $voice_id = explode('___', $key);
                $voice = Voice::where('voice_id', $voice_id[0])->first();
                $language = VoiceoverLanguage::where('language_code', $voice->language_code)->first();
                $no_ssml_tags = preg_replace('/<[\s\S]+?>/', '', $value);


                # Count characters based on vendor requirements
                switch ($voice->vendor) {
                    case 'gcp':
                            $text_characters = mb_strlen($value, 'UTF-8');
                            $total_text_characters += $text_characters;
                        break;
                    case 'azure':
                            $text_characters = $this->countAzureCharacters($voice, $value);
                            $total_text_characters += $text_characters;
                        break;
                }
                
                
                # Check if user has characters available to proceed
                if ((Auth::user()->available_chars + Auth::user()->available_chars_prepaid) < $total_characters) {
                    return response()->json(["error" => __("Not enough available characters to process")], 422);
                } else {
                    $this->updateAvailableCharacters($total_characters);
                } 
                

                # Name and extention of the audio file
                if (request('format') == 'mp3') {
                    $file_name = 'LISTEN--' . Str::random(10) . '.mp3';
                } elseif (request('format') == 'ogg')  {                
                    $file_name = 'LISTEN--' . Str::random(10) .'.ogg';
                } elseif (request('format') == 'webm') {
                    $file_name = 'LISTEN--' . Str::random(10) .'.webm';
                } elseif (request('format') == 'wav') {
                        $file_name = 'LISTEN--' . Str::random(10) .'.wav';
                } else {
                    return response()->json(["error" => __("Unsupported audio file extension was selected")], 422);
                } 


                switch ($voice->vendor) {
                    case 'azure':
                            if (request('format') != 'wav') {
                                $response = $this->processText($voice, $value, request('format'), $file_name);
                            } else {continue 2;}
                        break;
                    case 'gcp':
                            if (request('format') != 'webm') {
                                $response = $this->processText($voice, $value, request('format'), $file_name);
                            } else {continue 2;}
                        break;
                    default:
                        # code...
                        break;
                }


                if ($length == 1) {

                    if (config('settings.voiceover_default_storage') === 'aws') {
                        Storage::disk('s3')->writeStream($file_name, Storage::disk('audio')->readStream($file_name));
                        $result_url = Storage::disk('s3')->url($file_name); 
                        Storage::disk('audio')->delete($file_name);   
                    } elseif (config('settings.voiceover_default_storage') == 'wasabi') {
                        Storage::disk('wasabi')->writeStream($file_name, Storage::disk('audio')->readStream($file_name));
                        $result_url = Storage::disk('wasabi')->url($file_name);
                        Storage::disk('audio')->delete($file_name);                   
                    } else {               
                        $result_url = Storage::url($file_name);                
                    }

                    $result = new VoiceoverResult([
                        'user_id' => Auth::user()->id,
                        'language' => $language->language,
                        'voice' => $voice->voice,
                        'voice_id' => $voice_id[0],
                        'characters' => $text_characters,
                        'voice_type' => $voice->voice_type,
                        'file_name' => $file_name,
                        'text_raw' => $value,
                        'result_ext' => request('format'),
                        'result_url' => $result_url,
                        'audio_type' => $audio_type,
                        'plan_type' => $plan_type,
                        'vendor' => $voice->vendor,
                        'vendor_id' => $voice->vendor_id,
                        'mode' => 'live',
                    ]); 
                        
                    $result->save();

                    $data = [];
                    $data['old'] = auth()->user()->available_chars + auth()->user()->available_chars_prepaid;
                    $data['current'] = (auth()->user()->available_chars + auth()->user()->available_chars_prepaid) - $text_characters;

                    if (request('format') == 'mp3') {
                        $data['audio_type'] = 'audio/mpeg';
                    } elseif(request('format') == 'ogg') {
                        $data['audio_type'] = 'audio/ogg';
                    } elseif(request('format') == 'wav') {
                        $data['audio_type'] = 'audio/wav';
                    } elseif(request('format') == 'webm') {
                        $data['audio_type'] = 'audio/webm';
                    }
                    

                    if (config('settings.voiceover_default_storage') == 'local') 
                        $data['url'] = URL::asset($result_url);  
                    else            
                        $data['url'] = $result_url; 
                    
                    return $data;
                
                } else {

                    array_push($inputAudioFiles, 'storage/' . $response['name']);

                    $result = new VoiceoverResult([
                        'user_id' => Auth::user()->id,
                        'language' => $language->language,
                        'voice' => $voice->voice,
                        'vendor' => $voice->vendor,
                        'vendor_id' => $voice->vendor_id,
                        'voice_id' => $voice_id[0],
                        'text_raw' => $value,
                        'characters' => $text_characters,
                        'voice_type' => $voice->voice_type,
                        'plan_type' => $plan_type,
                        'mode' => 'hidden',
                    ]); 
                        
                    $result->save();
                }  
            }

            if ($length > 1) {

                # Name and extention of the main audio file
                if (request('format') == 'mp3') {
                    $file_name = Str::random(10) . '.mp3';
                } elseif (request('format') == 'wav') {
                    $file_name = Str::random(10) .'.wav';
                } elseif (request('format') == 'ogg') {
                    $file_name = Str::random(10) .'.ogg';
                } elseif (request('format') == 'webm') {
                    $file_name = Str::random(10) .'.webm';
                } else {
                    return response()->json(["error" => __("Unsupported audio file extension was selected")], 422);
                } 

                $user = new Service();
                $upload = $user->upload();
                if (!$upload['status']) return;  

                $this->merge_files->merge(request('format'), $inputAudioFiles, 'storage/'. $file_name);

                if (config('settings.voiceover_default_storage') === 'aws') {
                    Storage::disk('s3')->writeStream($file_name, Storage::disk('audio')->readStream($file_name));
                    $result_url = Storage::disk('s3')->url($file_name); 
                    Storage::disk('audio')->delete($file_name);   
                } elseif (config('settings.voiceover_default_storage') == 'wasabi') {
                    Storage::disk('wasabi')->writeStream($file_name, Storage::disk('audio')->readStream($file_name));
                    $result_url = Storage::disk('wasabi')->url($file_name);
                    Storage::disk('audio')->delete($file_name);                   
                } else {                
                    $result_url = Storage::url($file_name);                
                }

                $result = new VoiceoverResult([
                    'user_id' => Auth::user()->id,
                    'language' => $language->language,
                    'language_flag' => $language->language_flag,
                    'voice' => $voice->voice,
                    'voice_id' => $voice_id[0],
                    'characters' => $total_text_characters,
                    'voice_type' => 'mixed',
                    'file_name' => $file_name,
                    'text_raw' => $total_text_raw,
                    'result_ext' => request('format'),
                    'result_url' => $result_url,
                    'audio_type' => $audio_type,
                    'plan_type' => $plan_type,
                    'vendor' => $voice->vendor,
                    'vendor_id' => $voice->vendor_id,
                    'mode' => 'live',
                ]); 
                    
                $result->save();

                # Clean all temp audio files
                foreach ($inputAudioFiles as $value) {
                    $name_array = explode('/', $value);
                    $name = end($name_array);
                    if (Storage::disk('audio')->exists($name)) {
                        Storage::disk('audio')->delete($name);
                    }
                }                

                $data = [];
                $data['old'] = auth()->user()->available_chars + auth()->user()->available_chars_prepaid;
                $data['current'] = (auth()->user()->available_chars + auth()->user()->available_chars_prepaid) - $total_text_characters;

                if (request('format') == 'mp3') {
                    $data['audio_type'] = 'audio/mpeg';
                } elseif(request('format') == 'ogg') {
                    $data['audio_type'] = 'audio/ogg';
                } elseif(request('format') == 'wav') {
                    $data['audio_type'] = 'audio/wav';
                } elseif(request('format') == 'webm') {
                    $data['audio_type'] = 'audio/webm';
                }
                

                if (config('settings.voiceover_default_storage') == 'local') 
                    $data['url'] = URL::asset($result->result_url);  
                else            
                    $data['url'] = $result->result_url; 
                
                return $data;
            }
        }
    }


    /**
     * Process listen synthesize request for a row.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listenRow(Request $request)
    {   
        if ($request->ajax()) {
        
            $input_text = (request('selected_text_length') > 0) ? request('selected_text') : request('row_text');
            $voice = Voice::where('voice_id', request('voice'))->first();
            $language = VoiceoverLanguage::where('language_code', $voice->language_code)->first();
            $no_ssml_tags = preg_replace('/<[\s\S]+?>/', '', $input_text);
            $plan_type = (Auth::user()->group == 'subscriber') ? 'paid' : 'free';


            # Count characters based on vendor requirements
            $total_characters = mb_strlen($input_text, 'UTF-8');


            # Count characters based on vendor requirements
            switch ($voice->vendor) {
                case 'gcp':
                        $text_characters = mb_strlen($input_text, 'UTF-8');
                    break;
                case 'azure':
                        $text_characters = $this->countAzureCharacters($voice, $input_text);
                    break;
            }
            
            # Limit of Max Chars for synthesizing          
            if ($total_characters > config('settings.voiceover_max_chars_limit')) {
                return response()->json(["error" => __("Total characters of your text is more than allowed. Please decrese the length of your text.")], 422);
            }
            

            # Maximum supported characters for single synthesize task is 5000 chars
            if ($total_characters > 5000) {
                return response()->json(["error" => __("Too many characters. Maximum 5000 characters are supported for a text synthesize task")], 422);
            } 

            # Check if user has characters available to proceed 
            if ((auth()->user()->available_chars + auth()->user()->available_chars_prepaid) < $total_characters) {
                if (!is_null(auth()->user()->member_of)) {
                    if (auth()->user()->member_use_credits_voiceover) {
                        $member = User::where('id', auth()->user()->member_of)->first();
                        if (($member->available_chars + $member->available_chars_prepaid) < $total_characters) {
                            return response()->json(["error" => __("Not enough available characters to process")], 422);
                        }
                    } else {
                        return response()->json(["error" => __("Not enough available characters to process")], 422);
                    }
                    
                } else {
                    return response()->json(["error" => __("Not enough available characters to process")], 422);
                } 

            } else {
                $this->updateAvailableCharacters($total_characters);
            } 
            

            # Name and extention of the audio file
            if (request('format') == 'mp3') {
                $file_name = 'LISTEN--' . Str::random(20) . '.mp3';
            } elseif (request('format') == 'ogg') {
                $file_name = 'LISTEN--' . Str::random(20) .'.ogg';
            } elseif (request('format') == 'wav') {
                $file_name = 'LISTEN--' . Str::random(20) .'.wav';
            } elseif (request('format') == 'webm') {
                $file_name = 'LISTEN--' . Str::random(20) .'.webm';
            } else {
                return response()->json(["error" => __("Unsupported audio file extension was selected")], 422);
            } 


            switch ($voice->vendor) {
                case 'azure':
                        if (request('format') != 'wav') {
                            $response = $this->processText($voice, $input_text, request('format'), $file_name);
                        } else {
                            return response()->json(["error" => __("Selected voice supports MP3, OGG and WEBM formats. You have selected WAV format. Please change it and try again.")], 422);
                        }
                    break;
                case 'gcp':
                        if (request('format') != 'webm') {
                            $response = $this->processText($voice, $input_text, request('format'), $file_name);
                        } else {
                            return response()->json(["error" => __("Selected voice supports MP3, OGG and WAV formats. You have selected WEBM format. Please change it and try again.")], 422);
                        }
                    break;
                default:
                    # code...
                    break;
            }

            if (config('settings.voiceover_default_storage') === 'aws') {
                Storage::disk('s3')->writeStream($file_name, Storage::disk('audio')->readStream($file_name));
                $result_url = Storage::disk('s3')->url($file_name); 
                Storage::disk('audio')->delete($file_name);   
            } elseif (config('settings.voiceover_default_storage') == 'wasabi') {
                Storage::disk('wasabi')->writeStream($file_name, Storage::disk('audio')->readStream($file_name));
                $result_url = Storage::disk('wasabi')->url($file_name);
                Storage::disk('audio')->delete($file_name);                   
            } else {                
                $result_url = Storage::url($file_name);                
            }

            $result = new VoiceoverResult([
                'user_id' => Auth::user()->id,
                'language' => $language->language,
                'voice' => $voice->voice,
                'voice_id' => $voice->voice_id,
                'characters' => $text_characters,
                'voice_type' => $voice->voice_type,
                'file_name' => $file_name,
                'text_raw' => $input_text,
                'result_ext' => request('format'),
                'result_url' => $result_url,
                'plan_type' => $plan_type,
                'vendor' => $voice->vendor,
                'vendor_id' => $voice->vendor_id,
                'mode' => 'live',
            ]); 

            $user = new Service();
            $upload = $user->upload();
            if (!$upload['status']) return;  
                   
            $result->save();


            $data = [];
            $data['old'] = auth()->user()->available_chars + auth()->user()->available_chars_prepaid;
            $data['current'] = (auth()->user()->available_chars + auth()->user()->available_chars_prepaid) - $text_characters;

            if (request('format') == 'mp3') {
                $data['audio_type'] = 'audio/mpeg';
            } elseif(request('format') == 'wav') {
                $data['audio_type'] = 'audio/wav';
            } elseif(request('format') == 'ogg') {
                $data['audio_type'] = 'audio/ogg';
            } elseif(request('format') == 'webm') {
                $data['audio_type'] = 'audio/webm';
            } 
            

            if (config('settings.voiceover_default_storage') == 'local') 
                $data['url'] = URL::asset($result_url);  
            else            
                $data['url'] = $result_url; 
            
            return $data;
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(VoiceoverResult $id)
    {
        if ($id->user_id == Auth::user()->id){

            return view('user.voiceover.show', compact('id'));     

        } else{
            return redirect()->route('user.voiceover');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {   
        if ($request->ajax()) {

            $result = VoiceoverResult::where('id', request('id'))->firstOrFail();  

            if ($result->user_id == Auth::user()->id){

                switch ($result->storage) {
                    case 'local':
                        if (Storage::disk('audio')->exists($result->file_name)) {
                            Storage::disk('audio')->delete($result->file_name);  
                        }
                        break;
                    case 'aws':
                        if (Storage::disk('s3')->exists($result->result_url)) {
                            Storage::disk('s3')->delete($result->result_url);
                        }
                        break;
                    case 'wasabi':
                        if (Storage::disk('wasabi')->exists($result->result_url)) {
                            Storage::disk('wasabi')->delete($result->result_url);
                        }
                        break;
                    default:
                        # code...
                        break;
                }

                $result->delete();

                return response()->json('success');    
    
            } else{
                return response()->json('error');
            } 
        }    
    }


    /**
     * Update user characters number
     */
    private function updateAvailableCharacters($characters)
    {
        $user = User::find(Auth::user()->id);

        if (Auth::user()->available_chars > $characters) {

            $total_chars = Auth::user()->available_chars - $characters;
            $user->available_chars = ($total_chars < 0) ? 0 : $total_chars;

        } elseif (Auth::user()->available_chars_prepaid > $characters) {

            $total_chars_prepaid = Auth::user()->available_chars_prepaid - $characters;
            $user->available_chars_prepaid = ($total_chars_prepaid < 0) ? 0 : $total_chars_prepaid;

        } elseif ((Auth::user()->available_chars + Auth::user()->available_chars_prepaid) == $characters) {

            $user->available_chars = 0;
            $user->available_chars_prepaid = 0;

        } else {

            if (!is_null(Auth::user()->member_of)) {

                $member = User::where('id', Auth::user()->member_of)->first();

                if ($member->available_chars > $characters) {

                    $total_chars = $member->available_chars - $characters;
                    $member->available_chars = ($total_chars < 0) ? 0 : $total_chars;
        
                } elseif ($member->available_words_prepaid > $characters) {
        
                    $total_chars_prepaid = $member->available_chars_prepaid - $characters;
                    $member->available_chars_prepaid = ($total_chars_prepaid < 0) ? 0 : $total_chars_prepaid;
        
                } elseif (($member->available_chars + $member->available_chars_prepaid) == $characters) {
        
                    $member->available_chars = 0;
                    $member->available_chars_prepaid = 0;
        
                } else {
                    $remaining = $characters - $member->available_chars;
                    $member->available_chars = 0;
    
                    $prepaid_left = $member->available_chars_prepaid - $remaining;
                    $member->available_chars_prepaid = ($prepaid_left < 0) ? 0 : $prepaid_left;
                }

                $member->update();

            } else {

                $remaining = $characters - Auth::user()->available_chars;
                $user->available_chars = 0;

                $used = Auth::user()->available_chars_prepaid - $remaining;
                $user->available_chars_prepaid = ($used < 0) ? 0 : $used;
            }

        }

        $user->update();
    }


    /**
     * Update user synthesize task number
     */
    private function updateSynthesizeTasks()
    {
        if (Auth::user()->synthesize_tasks > 0) {
            $user = User::find(Auth::user()->id);
            $user->synthesize_tasks = Auth::user()->synthesize_tasks - 1;
            $user->update();
        } 
    }

    
    /**
     * Count Azure charcters which, some are countes as 2
     */
    private function countAzureCharacters(Voice $voice, $text) 
    {
        switch ($voice->language_code) {
            case 'zh-HK':
            case 'zh-CN':
            case 'zh-TW':
            case 'ja-JP':
            case 'ko-KR':
                    $total_characters = mb_strlen($text, 'UTF-8') * 2;
                break;            
            default:
                    $total_characters = mb_strlen($text, 'UTF-8');
                break;
        }

        return $total_characters;
    }


    /**
     * Process text synthesizes based on the vendor/voice selected
     */
    private function processText(Voice $voice, $text, $format, $file_name)
    {   
        $gcp = new GCPTTSService();
        $azure = new AzureTTSService();
        
        switch($voice->vendor) {
            case 'azure':
                return $azure->synthesizeSpeech($voice, $text, $format, $file_name);
                break;
            case 'gcp':
                return $gcp->synthesizeSpeech($voice, $text, $format, $file_name);
                break;
        }
    }


    /**
     * Send settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function config(Request $request)
    {   
        if ($request->ajax()) { 

            $data['char_limit'] = config('settings.voiceover_max_chars_limit');
            $data['voice_limit'] = config('settings.voiceover_max_voice_limit');

            return response()->json($data);   
        }    
    }

}
