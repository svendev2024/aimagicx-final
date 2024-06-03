<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Vendor;
use App\Models\ApiKey;
use App\Models\Setting;
use Yajra\DataTables\DataTables;
use DB;


class DavinciConfigController extends Controller
{
    /**
     * Display TTS configuration settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::orderBy('languages.language', 'asc')->get();
        $settings = Setting::where('name', 'words_filter')->first();

        # Set Voice Types
        $voiceover_languages = DB::table('voices')
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

        return view('admin.davinci.configuration.index', compact('languages', 'voiceover_languages', 'voices', 'settings'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'default-model-admin' => 'required',
            'language' => 'required',
            'tone' => 'required',
            'creativity' => 'required',
            'templates-admin' => 'required',
            'max-results-admin' => 'required|integer',
            'default-model-user' => 'required',
            'free-tier-words' => 'required|integer',
            'free-tier-images' => 'required|integer',
            'image-feature-user' => 'required',
            'max-results-user' => 'required|integer',
            'templates-user' => 'required',
        ]);    

        $this->storeConfiguration('DAVINCI_SETTINGS_DEFAULT_STORAGE', request('default-storage'));
        $this->storeConfiguration('DAVINCI_SETTINGS_DEFAULT_DURATION', request('default-duration'));
        $this->storeConfiguration('DAVINCI_SETTINGS_DEFAULT_MODEL_ADMIN', request('default-model-admin'));
        $this->storeConfiguration('DAVINCI_SETTINGS_DEFAULT_MODEL_USER', request('default-model-user'));
        $this->storeConfiguration('DAVINCI_SETTINGS_DEFAULT_LANGUAGE', request('language'));
        $this->storeConfiguration('DAVINCI_SETTINGS_TONE_DEFAULT_STATE', request('tone'));
        $this->storeConfiguration('DAVINCI_SETTINGS_CREATIVITY_DEFAULT_STATE', request('creativity'));
        $this->storeConfiguration('DAVINCI_SETTINGS_TEMPLATES_ACCESS_ADMIN', request('templates-admin'));
        $this->storeConfiguration('DAVINCI_SETTINGS_TEMPLATES_ACCESS_USER', request('templates-user'));
        $this->storeConfiguration('DAVINCI_SETTINGS_FREE_TIER_WORDS', request('free-tier-words'));
        $this->storeConfiguration('DAVINCI_SETTINGS_FREE_TIER_IMAGES', request('free-tier-images'));
        $this->storeConfiguration('DAVINCI_SETTINGS_IMAGE_FEATURE_USER', request('image-feature-user'));
        $this->storeConfiguration('DAVINCI_SETTINGS_IMAGE_SERVICE_VENDOR', request('image-vendor'));
        $this->storeConfiguration('DAVINCI_SETTINGS_IMAGE_STABLE_DIFFUSION_ENGINE', request('stable-diffusion-engine'));
        $this->storeConfiguration('DAVINCI_SETTINGS_CODE_FEATURE_USER', request('code-feature-user'));
        $this->storeConfiguration('DAVINCI_SETTINGS_CHAT_FEATURE_USER', request('chat-feature-user'));
        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_FEATURE_USER', request('voiceover-feature-user'));
        $this->storeConfiguration('DAVINCI_SETTINGS_WHISPER_FEATURE_USER', request('whisper-feature-user'));
        $this->storeConfiguration('DAVINCI_SETTINGS_MAX_RESULTS_LIMIT_ADMIN', request('max-results-admin'));
        $this->storeConfiguration('DAVINCI_SETTINGS_MAX_RESULTS_LIMIT_USER', request('max-results-user'));
        $this->storeConfiguration('DAVINCI_SETTINGS_CHATS_ACCESS_USER', request('chat-user'));
        $this->storeConfiguration('OPENAI_SECRET_KEY', request('secret-key'));
        $this->storeConfiguration('STABLE_DIFFUSION_API_KEY', request('stable-diffusion-key'));
        $this->storeConfiguration('DAVINCI_SETTINGS_SD_KEY_USAGE', request('sd-key-usage'));
        $this->storeConfiguration('DAVINCI_SETTINGS_OPENAI_KEY_USAGE', request('openai-key-usage'));
        $this->storeConfiguration('DAVINCI_SETTINGS_TEAM_MEMBERS_FEATURE', request('team-members-feature'));
        $this->storeConfiguration('DAVINCI_SETTINGS_TEAM_MEMBERS_QUANTITY', request('team-members-quantity'));

        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_ENABLE_AZURE', request('enable-azure'));
        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_ENABLE_GCP', request('enable-gcp'));
        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_SSML_EFFECT', request('set-ssml-effects'));
        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_MAX_CHAR_LIMIT', request('set-max-chars'));
        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_MAX_VOICE_LIMIT', request('set-max-voices'));
        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_DEFAULT_STORAGE', request('set-storage-option'));
        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_DEFAULT_DURATION', request('voiceover-default-duration'));
        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_DEFAULT_LANGUAGE', request('language'));
        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_DEFAULT_VOICE', request('voice'));
        $this->storeConfiguration('DAVINCI_SETTINGS_VOICEOVER_FREE_TIER_WELCOME_CHARS', request('set-free-chars'));

        $this->storeConfiguration('DAVINCI_SETTINGS_WHISPER_MAX_AUDIO_SIZE', request('set-max-audio-size'));
        $this->storeConfiguration('DAVINCI_SETTINGS_WHISPER_DEFAULT_STORAGE', request('set-whisper-storage-option'));
        $this->storeConfiguration('DAVINCI_SETTINGS_WHISPER_DEFAULT_DURATION', request('whisper-default-duration'));
        $this->storeConfiguration('DAVINCI_SETTINGS_WHISPER_FREE_TIER_WELCOME_MINUTES', request('set-free-minutes'));

        $this->storeConfiguration('AWS_ACCESS_KEY_ID', request('set-aws-access-key'));
        $this->storeConfiguration('AWS_SECRET_ACCESS_KEY', request('set-aws-secret-access-key'));
        $this->storeConfiguration('AWS_DEFAULT_REGION', request('set-aws-region'));
        $this->storeConfiguration('AWS_BUCKET', request('set-aws-bucket'));

        $this->storeConfiguration('WASABI_ACCESS_KEY_ID', request('set-wasabi-access-key'));
        $this->storeConfiguration('WASABI_SECRET_ACCESS_KEY', request('set-wasabi-secret-access-key'));
        $this->storeConfiguration('WASABI_DEFAULT_REGION', request('set-wasabi-region'));
        $this->storeConfiguration('WASABI_BUCKET', request('set-wasabi-bucket'));

        $this->storeConfiguration('AZURE_SUBSCRIPTION_KEY', request('set-azure-key'));
        $this->storeConfiguration('AZURE_DEFAULT_REGION', request('set-azure-region'));
        $this->storeConfiguration('GOOGLE_APPLICATION_CREDENTIALS', request('gcp-configuration-path'));

        Setting::where('name', 'words_filter')->update(['value' => request('words-filter')]);

        # Enable/Disable GCP Voices
        if (request('enable-gcp') == 'on') {
            $gcp_nrl = Vendor::where('vendor_id', 'gcp_nrl')->first();
            $gcp_nrl->enabled = 1;
            $gcp_nrl->save();

        } else {
            $gcp_nrl = Vendor::where('vendor_id', 'gcp_nrl')->first();
            $gcp_nrl->enabled = 0;
            $gcp_nrl->save();
        }


        if (request('enable-gcp') == 'on') {
            DB::table('voices')->where('vendor_id', 'gcp_nrl')->update(array('status' => 'active'));
    
        } else {
            DB::table('voices')->where('vendor_id', 'gcp_nrl')->update(array('status' => 'deactive'));
        }


        # Enable/Disable Azure Voices
        if (request('enable-azure') == 'on') {
            $azure_nrl = Vendor::where('vendor_id', 'azure_nrl')->first();
            $azure_nrl->enabled = 1;
            $azure_nrl->save();

        } else {
            $azure_nrl = Vendor::where('vendor_id', 'azure_nrl')->first();
            $azure_nrl->enabled = 0;
            $azure_nrl->save();
        }


        if (request('enable-azure') == 'on') {
            DB::table('voices')->where('vendor_id', 'azure_nrl')->update(array('status' => 'active'));
    
        } else {
            DB::table('voices')->where('vendor_id', 'azure_nrl')->update(array('status' => 'deactive'));
        }

        toastr()->success(__('Settings were successfully updated'));
        return redirect()->back();       
    }


    /**
     * Record in .env file
     */
    private function storeConfiguration($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showKeys(Request $request)
    {
        if ($request->ajax()) {
            $data = ApiKey::orderBy('engine', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function($row){
                    $actionBtn = '<div>      
                                    <a class="editButton" id="' . $row["id"] . '" href="#"><i class="fa fa-edit table-action-buttons view-action-button" title="Update API Key"></i></a>          
                                    <a class="activateButton" id="' . $row["id"] . '" href="#"><i class="fa fa-check table-action-buttons request-action-button" title="Activate or Deactivate API Key"></i></a>
                                    <a class="deleteButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete API Key"></i></a> 
                                </div>';     
                    return $actionBtn;
                })
                ->addColumn('created-on', function($row){
                    $created_on = '<span class="font-weight-bold">'.date_format($row["created_at"], 'd M Y').'</span><br><span>'.date_format($row["created_at"], 'H:i A').'</span>';
                    return $created_on;
                })
                ->addColumn('engine-name', function($row){
                    $name = ($row['engine'] == 'openai') ? 'OpenAI' : 'Stable Diffusion';
                    $user = '<span class="font-weight-bold">'. ucfirst($name) .'</span>';
                    return $user;
                }) 
                ->addColumn('status', function($row){
                    $status = ($row['status']) ? 'active' : 'deactive';
                    $user = '<span class="cell-box status-'.$status.'">'. ucfirst($status) .'</span>';
                    return $user;
                })
                ->rawColumns(['actions', 'created-on', 'engine-name', 'status'])
                ->make(true);
                    
        }

        return view('admin.davinci.configuration.keys');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createKeys(Request $request)
    {
        return view('admin.davinci.configuration.create');
    }


     /**
     * Store review post properly in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeKeys(Request $request)
    {
        request()->validate([
            'engine' => 'required',
            'api_key' => 'required',
            'status' => 'required',
        ]);  

        ApiKey::create([
            'engine' => $request->engine,
            'api_key' => $request->api_key,
            'status' => $request->status,
        ]);

        toastr()->success(__('API Key successfully stored'));
        return redirect()->route('admin.davinci.configs.keys');
    }


    /**
     * Update the api key
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        if ($request->ajax()) {

            $template = ApiKey::where('id', request('id'))->firstOrFail();
            
            $template->update(['api_key' => request('name')]);
            return  response()->json('success');
        } 
    }


    /**
     * Activate the api key
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request)
    {   
        if ($request->ajax()) {

            $template = ApiKey::where('id', request('id'))->firstOrFail();
            
            if ($template->status) {
                $template->update(['status' => false]);
                return  response()->json('deactive');
            } else {
                $template->update(['status' => true]);
                return  response()->json('active');
            }   
        } 
    }


    /**
     * Delete the api key
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {   
        if ($request->ajax()) {

            $name = ApiKey::find(request('id'));

            if($name) {

                $name->delete();

                return response()->json('success');

            } else{
                return response()->json('error');
            } 
        } 
    }

}



