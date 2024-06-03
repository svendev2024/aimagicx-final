<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Models\Workbook;
use App\Models\Content;
use App\Models\User;
use Yajra\DataTables\DataTables;
use DB;

class WorkbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Content::where('workbook', Auth::user()->workbook)->where('user_id', Auth::user()->id)->where('result_text', '<>', 'null')->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                            <a href="'. route("user.workbooks.show", $row["id"] ). '"><i class="fa-solid fa-file-lines table-action-buttons edit-action-button" title="View Document"></i></a>
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
                                    <div><a class="font-weight-bold" href="'. route("user.documents.show", $row["id"] ). '">'.ucfirst($row["title"]).'</a><br><span class="text-muted">'.ucfirst($row["template_name"]).'</span><div>
                                    </div>'; 
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
                    ->rawColumns(['actions', 'created-on', 'custom-language', 'custom-title', 'custom-group'])
                    ->make(true);
                    
        }

        $workbooks = Workbook::where('user_id', auth()->user()->id)->latest()->get();


        return view('user.documents.workbooks.index', compact('workbooks'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        if ($request->group == 'all') {
            if ($request->ajax()) {
                $data = Content::where('user_id', auth()->user()->id)->where('result_text', '<>', 'null')->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('actions', function($row){
                            $actionBtn = '<div>
                                                <a href="'. route("user.workbooks.show", $row["id"] ). '"><i class="fa-solid fa-file-lines table-action-buttons edit-action-button" title="View Document"></i></a>
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
                                        <div><a class="font-weight-bold" href="'. route("user.documents.show", $row["id"] ). '">'.ucfirst($row["title"]).'</a><br><span class="text-muted">'.ucfirst($row["template_name"]).'</span><div>
                                        </div>'; 
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
                        ->rawColumns(['actions', 'created-on', 'custom-language', 'custom-title', 'custom-group'])
                        ->make(true);          
            }

        } else {

            if ($request->ajax()) {
                $data = Content::where('workbook', $request->group)->where('user_id', auth()->user()->id)->where('result_text', '<>', 'null')->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('actions', function($row){
                            $actionBtn = '<div>
                                                <a href="'. route("user.workbooks.show", $row["id"] ). '"><i class="fa-solid fa-file-lines table-action-buttons edit-action-button" title="View Document"></i></a>
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
                                        <div><a class="font-weight-bold" href="'. route("user.documents.show", $row["id"] ). '">'.ucfirst($row["title"]).'</a><br><span class="text-muted">'.ucfirst($row["template_name"]).'</span><div>
                                        </div>'; 
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
                        ->rawColumns(['actions', 'created-on', 'custom-language', 'custom-title', 'custom-group'])
                        ->make(true);          
            }
        }

        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            request()->validate([
                'new-project' => 'required'
            ]);
    
            if (strtolower(request('new-project') == 'all')) {
                return response()->json(['status' => 'error', 'message' => __('Workbook Name is reserved and is already created, please create another one')]);
            }
    
            $check = Workbook::where('user_id', auth()->user()->id)->where('name', request('new-project'))->first();
    
            if (!isset($check)) {
                $project = new Workbook([
                    'user_id' => auth()->user()->id,
                    'name' =>  htmlspecialchars(request('new-project'))
                ]);
        
                $project->save();
                
                return response()->json(['status' => 'success', 'message' => __('Workbook has been successfully created')]);
            
            } else {
                return response()->json(['status' => 'error', 'message' => __('Workbook name already exists')]);
            }
        }  
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

            return view('user.documents.workbooks.show', compact('id', 'workbooks'));     

        } else{
            return redirect()->route('user.documents');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        request()->validate([
            'project' => 'required'
        ]);

        $check = Workbook::where('user_id', auth()->user()->id)->where('name', request('project'))->first();

        if (isset($check)) {
            $user = User::where('id', auth()->user()->id)->first();
            $user->workbook = request('project');
            $user->save();    

            toastr()->success(__('Default workbook has been successfully updated'));
            return redirect()->back();
        
        } else {
            toastr()->error(__('Default workbook has not been updated. Please try again'));
            return redirect()->back();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        request()->validate([
            'project' => 'required'
        ]);

        $project = Workbook::where('user_id', auth()->user()->id)->where('name', request('project'))->first();
        

        if (isset($project)) {

            $project->delete();

            Content::where('workbook', request('project'))->where('user_id', auth()->user()->id)->delete();

            $user = User::where('id', auth()->user()->id)->first();
            $user->workbook = ($user->workbook == request('project'))? '' : $user->workbook;
            $user->save();    

            toastr()->success(__('Selected workbook was deleted successfully'));
            return redirect()->back();
        
        } else {
            toastr()->error(__('Selected workbook was not deleted properly. Please try again'));
            return redirect()->back();
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

}
