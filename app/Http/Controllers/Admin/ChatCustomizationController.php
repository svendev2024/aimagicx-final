<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Chat;
use DataTables;

class ChatCustomizationController extends Controller
{
    /**
     * List all ai chats
     */
    public function chats(Request $request)
    {
        if ($request->ajax()) {
            $data = Chat::orderBy('category', 'asc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>        
                                        <a class="editButton" href="'. route("admin.davinci.chat.edit", $row["id"] ). '"><i class="fa fa-edit table-action-buttons view-action-button" title="Edit Chat Bot"></i></a>      
                                        <a class="activateButton" id="' . $row["id"] . '" href="#"><i class="fa fa-check table-action-buttons request-action-button" title="Activate Chat Bot"></i></a>
                                        <a class="deactivateButton" id="' . $row["id"] . '" href="#"><i class="fa fa-close table-action-buttons delete-action-button" title="Deactivate Chat Bot"></i></a>  
                                    </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["updated_at"], 'd M Y').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-status', function($row){
                        $status = ($row['status']) ? 'active' : 'deactive'; 
                        $custom_voice = '<span class="cell-box status-'. $status.'">'.ucfirst($status).'</span>';
                        return $custom_voice;
                    })
                    ->addColumn('custom-avatar', function($row){
                        if ($row['logo']) {
                            $path = URL::asset($row['logo']);
                        } else {
                            $path = URL::asset('img/users/avatar.jpg');
                        }

                        $avatar = '<div class="widget-user-image-sm overflow-hidden"><img alt="Voice Avatar" class="rounded-circle" src="' . $path . '"></div>';
                        return $avatar;
                    })
                    ->addColumn('custom-package', function($row){
                        switch ($row['category']) {
                            case 'all':
                                $package = '<span class="cell-box plan-regular">' . __('All') .'</span>';
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
                    ->rawColumns(['actions', 'created-on', 'custom-status', 'custom-avatar', 'custom-package'])
                    ->make(true);
                    
        }

        return view('admin.davinci.chats.index');
    }


    /**
     * Edit the specified chat
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $chat = Chat::where('id', $id)->first();

        return view('admin.davinci.chats.edit', compact('chat'));     
    }


    /**
     * Create new chat chat
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.davinci.chats.create');     
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $code = strtoupper(Str::random(5));
        $status = (request('activate') == 'on') ? true : false;

        $chat = new Chat([
            'status' => $status,
            'name' => request('name'),
            'sub_name' => request('character'),
            'description' => request('introduction'),
            'prompt' => request('prompt'),
            'category' => request('category'),
            'chat_code' => $code,
            'type' => 'custom'
        ]); 

        $chat->save();

        if (request()->has('logo')) {
        
            try {
                request()->validate([
                    'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:10048'
                ]);
                
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'PHP FileInfo is disabled: ' . $e->getMessage());
            }
            
            $image = request()->file('logo');

            $name = Str::random(5);

          
            $filePath = '/chats/' . $name . '.' . $image->getClientOriginalExtension();
            
            $this->uploadImage($image, 'chats/', 'public', $name);
            
            $chat->logo = $filePath;
            $chat->save();
        }

        toastr()->success(__('Chat Bot has been successfully created'));
        return redirect()->route('admin.davinci.chats');     
    }


    
    /**
     * Update the specified chat
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {   
        $chat = Chat::where('id', $id)->first();

        $status = (request('activate') == 'on') ? true : false;

        $chat->update([
            'status' => $status,
            'name' => request('name'),
            'sub_name' => request('character'),
            'description' => request('introduction'),
            'prompt' => request('prompt'),
            'category' => request('category'),
        ]);

        if (request()->has('logo')) {
        
            try {
                request()->validate([
                    'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:10048'
                ]);
                
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'PHP FileInfo is disabled: ' . $e->getMessage());
            }
            
            $image = request()->file('logo');

            $name = Str::random(5);

          
            $filePath = '/chats/' . $name . '.' . $image->getClientOriginalExtension();
            
            $this->uploadImage($image, 'chats/', 'public', $name);
            
            $chat->logo = $filePath;
            $chat->save();
        }

        toastr()->success(__('Chat Bot has been successfully updated'));
        return redirect()->route('admin.davinci.chats');     
    }


    /**
     * Enable the specified chat.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function chatActivate(Request $request)
    {
        if ($request->ajax()) {

            $voice = Chat::where('id', request('id'))->firstOrFail();  

            if ($voice->status == true) {
                return  response()->json('active');
            }

            $voice->update(['status' => true]);

            return  response()->json('success');
        }
    }


    /**
     * Disable the specified chat.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function chatDeactivate(Request $request)
    {
        if ($request->ajax()) {

            $voice = Chat::where('id', request('id'))->firstOrFail();  

            if ($voice->status == false) {
                return  response()->json('deactive');
            }

            $voice->update(['status' => false]);

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
