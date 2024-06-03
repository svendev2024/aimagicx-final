<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CustomTemplate;
use App\Models\Category;
use Yajra\DataTables\DataTables;

class CustomTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CustomTemplate::orderBy('group', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function($row){
                    $actionBtn = '<div>      
                                    <a href="'. route("admin.davinci.custom.show", $row["id"] ). '"><i class="fa fa-edit table-action-buttons view-action-button" title="Edit Template"></i></a>      
                                    <a class="changeButton" id="' . $row["id"] . '"  type="' . $row['type'] . '" href="#"><i class="fa-solid fa-square-parking table-action-buttons request-action-button" title="Set Template Package"></i></a>
                                    <a class="newButton" id="' . $row["id"] . '"  type="' . $row['type'] . '" href="#"><i class="fa-solid fa-sparkles table-action-buttons edit-action-button" title="Set as New Template"></i></a>
                                    <a class="activateButton" id="' . $row["id"] . '" type="' . $row['type'] . '" href="#"><i class="fa fa-check table-action-buttons request-action-button" title="Activate Template"></i></a>
                                    <a class="deactivateButton" id="' . $row["id"] . '" type="' . $row['type'] . '" href="#"><i class="fa fa-close table-action-buttons delete-action-button" title="Deactivate Template"></i></a>  
                                    <a class="deleteTemplate" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Template"></i></a> 
                                </div>';
                    
                    return $actionBtn;
                })
                ->addColumn('updated-on', function($row){
                    $created_on = '<span class="font-weight-bold">'.date_format($row["updated_at"], 'd M Y').'</span><br><span>'.date_format($row["updated_at"], 'H:i A').'</span>';
                    return $created_on;
                })
                ->addColumn('custom-name', function($row){
                    $user = '<div class="d-flex">
                                <div class="template-edit mr-2">'. $row['icon'] .'</div>
                                <div class="widget-user-name pt-1"><span class="font-weight-bold">'. $row['name'] .'</span></div>
                            </div>';
                    return $user;
                }) 
                ->addColumn('custom-package', function($row){
                    switch ($row['package']) {
                        case 'all':
                            $package = '<span class="cell-box plan-regular">' . __('Standard') .'</span>';
                            break;
                        case 'free':
                            $package = '<span class="cell-box plan-free">' . __('Free') .'</span>';
                            break;
                        case 'professional':
                            $package = '<span class="cell-box plan-professional">' . __('Professional') .'</span>';
                            break;
                        case 'premium':
                            $package = '<span class="cell-box plan-premium">' . __('Premium') .'</span>';
                            break;
                        default:
                            $package = '<span class="cell-box plan-regular">' . __('Standard') .'</span>';
                            break;
                    }                      
                    return $package;
                })
                ->addColumn('custom-new', function($row){
                    $icon = ($row['new']) ? '<i class="fa-solid fa-circle-check text-success fs-16"></i>' : '<i class="fa-solid fa-circle-xmark fs-16"></i>';
                    $custom_new = '<span class="font-weight-bold">'.$icon.'</span>';
                    return $custom_new;
                })
                ->addColumn('custom-status', function($row){
                    $status = ($row['status']) ? 'Active' : 'Deactive';
                    $custom_voice = '<span class="cell-box status-'.strtolower($status).'">'. $status.'</span>';
                    return $custom_voice;
                })
                ->rawColumns(['actions', 'updated-on', 'custom-name', 'custom-package', 'custom-status', 'custom-new'])
                ->make(true);
                    
        }

        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.davinci.custom.index', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'icon' => 'required',
        ]);     
        
        $template_code = strtoupper(Str::random(5));
        $status = (isset($request->activate)) ? true : false;
        $tone = (isset($request->tone)) ? true : false;
        $icon = ($request->category == 'text') ? str_replace('"></i>', ' main-icon"></i>', $request->icon) : str_replace('"></i>', ' ' . $request->category . '-icon"></i>', $request->icon);

        $fields = array();

        foreach ($request->names as $key => $value) {
            if (!is_null($value)) {
                $fields[$key]['name'] = $value;
                $fields[$key]['placeholder'] = $request->placeholders[$key];
                $fields[$key]['input'] = $request->input_field[$key];
                $fields[$key]['code'] = $request->code[$key];
            }
        }

        $template = new CustomTemplate([
            'user_id' => auth()->user()->id,
            'description' => $request->description,
            'status' => $status,
            'professional' => false,
            'template_code' => $template_code,
            'name' => $request->name,
            'icon' => $icon,
            'group' => $request->category,
            'slug' => 'custom-template',
            'prompt' => $request->prompt,
            'tone' => $tone,
            'fields' => $fields,
            'package' => $request->package,
        ]); 
        
        $template->save();            

        toastr()->success(__('Custom Template was successfully created'));
        return redirect()->back();       
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CustomTemplate $id)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.davinci.custom.edit', compact('id', 'categories'));
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomTemplate $id)
    {        
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'icon' => 'required',
        ]); 

        $status = (isset($request->activate)) ? true : false;
        $tone = (isset($request->tone)) ? true : false;
        $icon = ($request->category == 'text') ? str_replace('"></i>', ' main-icon"></i>', $request->icon) : str_replace('"></i>', ' ' . $request->category . '-icon"></i>', $request->icon);

        $fields = array();

        foreach ($request->names as $key => $value) {
            if (!is_null($value)) {
                $fields[$key]['name'] = $value;
                $fields[$key]['placeholder'] = $request->placeholders[$key];
                $fields[$key]['input'] = $request->input_field[$key];
                $fields[$key]['code'] = $request->code[$key];
            }
        }

        $id->update([
            'description' => $request->description,
            'status' => $status,
            'name' => $request->name,
            'icon' => $icon,
            'group' => $request->category,
            'prompt' => $request->prompt,
            'tone' => $tone,
            'fields' => $fields,
            'package' => $request->package,
        ]); 

        toastr()->success(__('Custom Template was successfully updated'));
        return redirect()->route('admin.davinci.custom');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::orderBy('name', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function($row){
                    $actionBtn = '<div>      
                                    <a class="editButton" id="' . $row["id"] . '" href="#"><i class="fa fa-edit table-action-buttons view-action-button" title="Change Category Name"></i></a>          
                                    <a class="editDescription" id="' . $row["id"] . '" href="#"><i class="fa-solid fa-money-check-pen table-action-buttons view-action-button" title="Update Category Description"></i></a>          
                                    <a class="deleteButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Category"></i></a> 
                                </div>';     
                    return $actionBtn;
                })
                ->addColumn('updated-on', function($row){
                    $created_on = '<span class="font-weight-bold">'.date_format($row["updated_at"], 'd M Y').'</span><br><span>'.date_format($row["updated_at"], 'H:i A').'</span>';
                    return $created_on;
                })
                ->addColumn('custom-name', function($row){
                    $user = '<span class="font-weight-bold">'. ucfirst($row['name']) .'</span>';
                    return $user;
                }) 
                ->addColumn('custom-type', function($row){
                    $color = ($row['type'] == 'original') ? 'category-blog' : 'category-main';
                    $user = '<span class="cell-box '.$color.'">'. ucfirst($row['type']) .'</span>';
                    return $user;
                })
                ->rawColumns(['actions', 'updated-on', 'custom-name', 'custom-type'])
                ->make(true);
                    
        }

        return view('admin.davinci.custom.category');
    }


    /**
     * Update the name.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {   
        if ($request->ajax()) {

            $template = Category::where('id', request('id'))->firstOrFail();
            
            $template->update(['name' => request('name')]);
            return  response()->json('success');
        } 
    }


    /**
     * Update the description.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function description(Request $request)
    {   
        if ($request->ajax()) {

            $template = Category::where('id', request('id'))->firstOrFail();
            
            $template->update(['description' => request('name')]);
            return  response()->json('success');
        } 
    }


    /**
     * Create category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        if ($request->ajax()) {

            $code = strtolower(Str::random(5));

            $template = new Category([
                'name' => $request->name,
                'code' => $code,
                'type' => 'custom',
            ]); 
            
            $template->save();  
            
            toastr()->success(__('New category was successfully created'));
            return  response()->json('success');
        } 
    }


    public function delete(Request $request)
    {   
        if ($request->ajax()) {

            $name = Category::find(request('id'));

            if($name) {

                $name->delete();

                return response()->json('success');

            } else{
                return response()->json('error');
            } 
        } 
    }

}
