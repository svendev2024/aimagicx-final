<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Voice;
use DataTables;

class VoiceCustomizationController extends Controller
{
    /**
     * List all voiceover voices
     */
    public function voices(Request $request)
    {
        if ($request->ajax()) {
            $data = Voice::select('voices.*', 'voiceover_languages.language', 'voiceover_languages.language_flag')->join('voiceover_languages', 'voices.language_code', '=', 'voiceover_languages.language_code')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>        
                                        <a class="changeVoiceNameButton" id="' . $row["id"] . '" href="#"><i class="fa fa-edit table-action-buttons view-action-button" title="Rename Voice"></i></a>      
                                        <a class="changeAvatarButton" id="' . $row["id"] . '" href="#"><i class="fa-solid fa-user-astronaut table-action-buttons edit-action-button" title="Change Avatar"></i></a>
                                        <a class="activateVoiceButton" id="' . $row["id"] . '" href="#"><i class="fa fa-check table-action-buttons request-action-button" title="Activate Voice"></i></a>
                                        <a class="deactivateVoiceButton" id="' . $row["id"] . '" href="#"><i class="fa fa-close table-action-buttons delete-action-button" title="Deactivate Voice"></i></a>  
                                    </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["updated_at"], 'd M Y').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-voice-type', function($row){
                        $custom_voice = '<span class="cell-box voice-'.strtolower($row["voice_type"]).'">'.ucfirst($row["voice_type"]).'</span>';
                        return $custom_voice;
                    })
                    ->addColumn('custom-status', function($row){
                        $custom_voice = '<span class="cell-box status-'.strtolower($row["status"]).'">'.ucfirst($row["status"]).'</span>';
                        return $custom_voice;
                    })
                    ->addColumn('single', function($row){
                        $url = ($row['storage'] == 'local') ? URL::asset($row['sample_url']) : $row['sample_url'];
                        $result = '<button type="button" class="result-play pl-0" onclick="resultPlay(this)" src="' . $url . '" type="'. $row['audio_type'].'" id="'. $row['id'] .'"><i class="fa fa-play table-action-buttons view-action-button" title="Listen Voice Sample"></i></button>';
                        return $result;
                    })
                    ->addColumn('vendor', function($row){
                        $path = URL::asset($row['vendor_img']);
                        $vendor = '<div class="vendor-image-sm overflow-hidden"><img alt="vendor" class="rounded-circle" src="' . $path . '"></div>';
                        return $vendor;
                    })
                    ->addColumn('avatar', function($row){
                        if ($row['avatar_url']) {
                            $path = URL::asset($row['avatar_url']);
                        } else {
                            $path = URL::asset('img/users/avatar.jpg');
                        }

                        $avatar = '<div class="widget-user-image-sm overflow-hidden"><img alt="Voice Avatar" class="rounded-circle" src="' . $path . '"></div>';
                        return $avatar;
                    })
                    ->addColumn('custom-language', function($row) {
                        $language = '<span class="vendor-image-sm overflow-hidden"><img class="mr-2" src="' . URL::asset($row['language_flag']) . '">'. $row['language'] .'</span> ';            
                        return $language;
                    })
                    ->rawColumns(['actions', 'created-on', 'custom-voice-type', 'vendor', 'single', 'custom-status', 'avatar', 'custom-language'])
                    ->make(true);
                    
        }

        return view('admin.davinci.voices.index');
    }


    public function changeAvatar(Request $request) {

        if (request()->has('avatar')) {
        
            try {
                request()->validate([
                    'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1048'
                ]);
                
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'PHP FileInfo: ' . $e->getMessage());
            }
            
            $image = request()->file('avatar');

            $name = Str::random(10);

            $voice = Voice::find(request('id'));
         
            switch ($voice->vendor) {
                case 'azure':
                    $folder = 'voices/azure/avatars/';
                    break;
                case 'gcp':
                    $folder = 'voices/gcp/avatars/';
                    break;
                default:
                    $folder = 'voices/vatars/';
                    break;
            }
          
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            
            $this->uploadImage($image, $folder, 'public', $name);
            
            $voice->avatar_url = $filePath;
            $voice->save();

            return  response()->json('success');
        }
    }


    /**
     * Update the specified voice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voiceUpdate(Request $request)
    {   
        if ($request->ajax()) {

            $voice = Voice::where('id', request('id'))->firstOrFail(); 

            $voice->update(['voice' => request('name')]);
            return  response()->json('success');
        }  
    }


    /**
     * Enable the specified voice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voiceActivate(Request $request)
    {
        if ($request->ajax()) {

            $voice = Voice::where('id', request('id'))->firstOrFail();  

            if ($voice->status == 'active') {
                return  response()->json('active');
            }

            $voice->update(['status' => 'active']);

            return  response()->json('success');
        }
    }


    /**
     * Enable all voices.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voicesActivateAll(Request $request)
    {
        if ($request->ajax()) {

            Voice::query()->update(['status' => 'active']);

            return  response()->json('success');
        }          
    }


    /**
     * Disable the specified voice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voiceDeactivate(Request $request)
    {
        if ($request->ajax()) {

            $voice = Voice::where('id', request('id'))->firstOrFail();  

            if ($voice->status == 'deactive') {
                return  response()->json('deactive');
            }

            $voice->update(['status' => 'deactive']);

            return  response()->json('success');
        }    
    }


    /**
     * Disable all voices.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voicesDeactivateAll(Request $request)
    {
        if ($request->ajax()) {

            Voice::query()->update(['status' => 'deactive']);

            return  response()->json('success');
        }     
    }


    /**
     * Upload voice avatar image
     */
    public function uploadImage(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $image = $file->storeAs($folder, $name .'.'. $file->getClientOriginalExtension(), $disk);

        return $image;
    }
}
