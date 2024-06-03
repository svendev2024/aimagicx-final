<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\VoiceoverResult;
use App\Models\Workbook;
use App\Models\Content;
use App\Models\Image;
use App\Models\Transcript;
use App\Models\Code;
use Yajra\DataTables\DataTables;
use DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Content::where('user_id', Auth::user()->id)->where('result_text', '<>', 'null')->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                            <a href="'. route("user.documents.show", $row["id"] ). '"><i class="fa-solid fa-file-lines table-action-buttons edit-action-button" title="View Document"></i></a>
                                            <a class="deleteResultButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Document"></i></a> 
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span class="font-weight-bold">'.date_format($row["created_at"], 'd M Y').'</span><br><span>'.date_format($row["created_at"], 'H:i A').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-title', function($row){
                        $custom = '<div class="d-flex">
                                    <div class="mr-2">' . $row['icon'] . '</div>
                                    <div><a class="font-weight-bold document-title" href="'. route("user.documents.show", $row["id"] ). '">'.ucfirst($row["title"]).'</a><br><span class="text-muted">'.ucfirst($row["template_name"]).'</span><div>
                                    </div>'; 
                        return $custom;
                    })
                    ->addColumn('custom-workbook', function($row){
                        $custom = '<span>'.ucfirst($row["workbook"]).'</span>';
                        return $custom;
                    })
                    ->addColumn('custom-group', function($row){
                        $group = ($row['group'] == 'text') ? 'content' : $row['group'];
                        $custom =  '<span class="cell-box category-'.strtolower($row["group"]).'">'.ucfirst($group).'</span>';
                        return $custom;
                    })
                    ->addColumn('custom-language', function($row) {
                        $language = '<span class="vendor-image-sm overflow-hidden"><img class="mr-2" src="' . URL::asset($row['language_flag']) . '">'. $row['language_name'] .'</span> ';            
                        return $language;
                    })
                    ->rawColumns(['actions', 'created-on', 'custom-language', 'custom-title', 'custom-workbook', 'custom-group'])
                    ->make(true);
                    
        }


        return view('user.documents.documents.index');
    }


    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function images(Request $request)
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
                                <div class="widget-user-image-sm overflow-hidden mr-4"><img alt="Avatar" src="' . $path . '"></div>
                                <div><a class="file-name font-weight-bold" href="#" id="'.$row["id"].'">' . $row['name'] . '</a><br><span class="text-muted">'.$row["description"].'</span></div>
                            </div>';                        
                        return $user;
                    })
                    ->rawColumns(['actions', 'created-on', 'custom-image'])
                    ->make(true);
                    
        }

        return view('user.documents.images.index');
    }


    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voiceovers(Request $request)
    {   
        if ($request->ajax()) {
            $data = VoiceoverResult::where('user_id', Auth::user()->id)->where('mode', 'file')->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>                                            
                                            <a href="'. route("user.documents.voiceover.show", $row["id"] ). '"><i class="fa-solid fa-list-music table-action-buttons edit-action-button" title="View Result"></i></a>
                                            <a class="deleteResultButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Result"></i></a>
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'd M Y').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-voice-type', function($row){
                        $custom_voice = '<span class="cell-box voice-'.strtolower($row["voice_type"]).'">'.ucfirst($row["voice_type"]).'</span>';
                        return $custom_voice;
                    })                   
                    ->addColumn('result', function($row){
                        $result = ($row['storage'] == 'local') ? URL::asset($row['result_url']) : $row['result_url'];
                        return $result;
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
                    ->addColumn('custom-language', function($row) {
                        $language = '<span class="vendor-image-sm overflow-hidden"><img class="mr-2" src="' . URL::asset($row['language_flag']) . '">'. $row['language'] .'</span> ';            
                        return $language;
                    })
                    ->rawColumns(['actions', 'created-on', 'custom-voice-type', 'result', 'download', 'single', 'custom-language'])
                    ->make(true);
                    
        }


        return view('user.documents.voiceover.index');
    }


    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transcripts(Request $request)
    {   
        if ($request->ajax()) {
            $data = Transcript::where('user_id', Auth::user()->id)->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                            <a id="'.$row["id"].'" href="'. route('user.documents.transcript.show', $row['id']) .'" class="transcribeResult"><i class="fa fa-clipboard table-action-buttons edit-action-button" title="View Result"></i></a> 
                                            <a class="deleteResultButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Result"></i></a>
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'd M Y').'</span>';
                        return $created_on;
                    })        
                    ->addColumn('custom-length', function($row) {
                        $custom_voice = '<span>'.gmdate("H:i:s", $row['length']).'</span>';
                        return $custom_voice;
                    })         
                    ->addColumn('result', function($row) {
                        $result = ($row['storage'] == 'local') ? URL::asset($row['url']) : $row['url'];
                        return $result;
                    })
                    ->addColumn('download', function($row){
                        $result = ($row['storage'] == 'local') ? URL::asset($row['url']) : $row['url'];
                        $result = '<a class="result-download" href="' . $row['url'] . '" download title="Download Audio"><i class="fa fa-cloud-download table-action-buttons download-action-button"></i></a>';
                        return $result;
                    })
                    ->addColumn('single', function($row){
                        $audio = ($row['storage'] == 'local') ? URL::asset($row['url']) : $row['url'];
                        $result = '<button type="button" class="result-play pl-0" title="Play Audio" onclick="resultPlay(this)" src="' . $audio . '" id="'. $row['id'] .'"><i class="fa fa-play table-action-buttons view-action-button"></i></button>';
                        return $result;
                    })
                    ->addColumn('type', function($row){ 
                        $result = '<span class="cell-box task-'.strtolower($row["task"]).'">'.ucfirst(__($row["task"])).'</span>';;
                        return $result;
                    })
                    ->rawColumns(['actions', 'created-on', 'custom-length', 'result', 'download', 'single', 'type'])
                    ->make(true);
                    
        }

        return view('user.documents.transcribe.index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function codes(Request $request)
    {
        if ($request->ajax()) {
            $data = Code::where('user_id', Auth::user()->id)->where('code', '<>', 'null')->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                            <a href="'. route("user.documents.code.show", $row["id"] ). '"><i class="fa-solid fa-file-lines table-action-buttons edit-action-button" title="View Document"></i></a>
                                            <a class="deleteResultButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Document"></i></a> 
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span class="font-weight-bold">'.date_format($row["created_at"], 'd M Y').'</span><br><span>'.date_format($row["created_at"], 'H:i A').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-title', function($row){
                        $custom = '<div class="d-flex">
                                    <div class="mr-2 flex"><i class="fa-solid fa-square-code blog-icon"></i></div>
                                    <div class="mt-1"><a class="font-weight-bold document-title" href="'. route("user.documents.code.show", $row["id"] ). '">'.ucfirst($row["title"]).'</a><div>
                                    </div>'; 
                        return $custom;
                    })
                    ->addColumn('language', function($row){
                        switch ($row['model']) {
                            case 'python':
                                $language = '<span class="cell-box category-main">Python</span>';                             
                                break;
                            case 'go':
                                $language = '<span class="cell-box category-main">Go</span>';                             
                                break;
                            case 'html':
                                $language = '<span class="cell-box category-email">HTML</span>';                             
                                break;
                            case 'perl':
                                $language = '<span class="cell-box category-social">Perl</span>';                             
                                break;
                            case 'ruby':
                                $language = '<span class="cell-box category-email">Ruby</span>';                             
                                break;
                            case 'javascript':
                                $language = '<span class="cell-box category-video">JavaScript</span>';                             
                                break;
                            case 'php':
                                $language = '<span class="cell-box category-blog">PHP</span>';                             
                                break;
                            case 'typescript':
                                $language = '<span class="cell-box category-video">TypeScript</span>';                             
                                break;
                            case 'shell':
                                $language = '<span class="cell-box category-video">Shell</span>';                             
                                break;
                            case 'swift':
                                $language = '<span class="cell-box category-social">Swift</span>';                             
                                break;
                            default:
                                $language = '<span class="cell-box category-other">Custom</span>';
                                break;
                        }
                        
                        return $language;
                    })
                    ->addColumn('custom-instructions', function($row){
                        $custom = '<span>'.Str::limit(ucfirst($row['instructions']), 100).'</span>';
                        return $custom;
                    })
                    ->rawColumns(['actions', 'created-on', 'custom-title', 'language'])
                    ->make(true);
                    
        }


        return view('user.documents.codex.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Content $id)
    {
        if ($id->user_id == Auth::user()->id){

            $workbooks = Workbook::where('user_id', auth()->user()->id)->latest()->get();

            return view('user.documents.documents.show', compact('id', 'workbooks'));     

        } else{
            return redirect()->route('user.documents');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showVoiceover(VoiceoverResult $id)
    {
        if ($id->user_id == Auth::user()->id){

            return view('user.documents.voiceover.show', compact('id'));     

        } else{
            return redirect()->route('user.documents.voiceovers');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTranscript(Transcript $id)
    {
        if ($id->user_id == Auth::user()->id){

            $end_time = gmdate("H:i:s", $id->length);
            $url = ($id->storage == 'local') ? URL::asset($id->url) : $id->url;
            $data['text'] = json_encode($id->transcript);
            $data['url'] = json_encode($url);

            $task_type = ($id->task == 'transcribe') ? __('Audio Transcription Task') : __('Audio Translation Task');
            $time = gmdate("H:i:s", $id->length);

            return view('user.documents.transcribe.show', compact('id', 'data', 'task_type', 'time'));     

        } else{
            return redirect()->route('user.documents.transcripts');
        }
      
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCode(Code $id)
    {
        if ($id->user_id == Auth::user()->id){

            $data['code'] = json_encode($id->code);

            return view('user.documents.codex.show', compact('id', 'data'));     

        } else{
            return redirect()->route('user.codex');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {

            $result = Content::where('id', request('id'))->firstOrFail();  

            if ($result->user_id == Auth::user()->id){

                $result->delete();

                return response()->json('success');    
    
            } else{
                return response()->json('error');
            } 
        }              
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteVoiceover(Request $request)
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
                        if (Storage::disk('s3')->exists($result->file_name)) {
                            Storage::disk('s3')->delete($result->file_name);
                        }
                        break;
                    case 'wasabi':
                        if (Storage::disk('wasabi')->exists($result->file_name)) {
                            Storage::disk('wasabi')->delete($result->file_name);
                        }
                        break;
                    default:
                        # code...
                        break;
                }

                $result->delete();

                $data['status'] = 'success';
                return $data;     
    
            } else{
                $data['status'] = 'error';
                $data['message'] = __('There was an error while deleting this synthesize result');
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
	public function deleteTranscript(Request $request) 
    {
        if ($request->ajax()) {

            $transcript = Transcript::where('id', request('id'))->first(); 

            if ($transcript->user_id == auth()->user()->id){

                switch ($transcript->storage) {
                    case 'local':
                        if (File::exists(public_path($transcript->url))) {
                            File::delete(public_path($transcript->url));
                        }
                        break;
                    case 'aws':
                        if (Storage::disk('s3')->exists($transcript->temp_name)) {
                            Storage::disk('s3')->delete($transcript->temp_name);
                        }
                        break;
                    case 'wasabi':
                        if (Storage::disk('wasabi')->exists($transcript->temp_name)) {
                            Storage::disk('wasabi')->delete($transcript->temp_name);
                        }
                        break;
                    default:
                        # code...
                        break;
                }

                $transcript->delete();

                $data['status'] = 'success';
                return $data;  
    
            } else{

                $data['status'] = 'error';
                $data['message'] = __('There was an error while deleting this transcript');
                return $data;
            }  
        }
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCode(Request $request)
    {
        if ($request->ajax()) {

            $result = Code::where('id', request('id'))->firstOrFail();  

            if ($result->user_id == Auth::user()->id){

                $result->delete();

                return response()->json('success');    
    
            } else{
                return response()->json('error');
            } 
        }              
    }

}
