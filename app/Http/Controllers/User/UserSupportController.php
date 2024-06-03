<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Mailers\AppMailer;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use DataTables;
use Carbon\Carbon;


class UserSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $data = SupportTicket::where('user_id', Auth::user()->id)->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                        <a href="'. route("user.support.show", $row["ticket_id"] ). '"><i class="fa-solid fa-message-question table-action-buttons view-action-button" title="View Support Ticket"></i></a>
                                        <a class="deleteNotificationButton" id="'. $row["ticket_id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Support Ticket"></i></a> 
                                    </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'd M Y H:i A').'</span>';
                        return $created_on;
                    })
                    ->addColumn('resolved-on', function($row){
                        if (!is_null($row['resolved_on'])) {
                            $updated_on = '<span>'.date_format(Carbon::parse($row["resolved_on"]), 'd M Y H:i A').'</span>';
                            return $updated_on;
                        } else {
                            return '';
                        }
                        
                    })
                    ->addColumn('custom-status', function($row){
                        $custom_status = '<span class="cell-box support-'.strtolower($row["status"]).'">'.$row["status"].'</span>';
                        return $custom_status;
                    })
                    ->addColumn('custom-priority', function($row){
                        $custom_priority = '<span class="cell-box priority-'.strtolower($row["priority"]).'">'.$row["priority"].'</span>';
                        return $custom_priority;
                    })
                    ->addColumn('custom-category', function($row){
                        $custom_priority = '<span class="font-weight-bold">'.$row["category"].'</span>';
                        return $custom_priority;
                    })
                    ->addColumn('custom-ticket', function($row){
                        $custom_priority = '<a class="font-weight-bold text-primary" href="'. route("user.support.show", $row["ticket_id"] ). '">'.$row["ticket_id"].'</a>';
                        return $custom_priority;
                    })
                    ->addColumn('custom-subject', function($row){
                        $custom_priority = '<a class="support-subject-text" href="'. route("user.support.show", $row["ticket_id"] ). '">'.$row["subject"].'</a>';
                        return $custom_priority;
                    })
                    ->rawColumns(['actions', 'custom-status', 'created-on', 'resolved-on', 'custom-priority', 'custom-category', 'custom-ticket', 'custom-subject'])
                    ->make(true);
                    
        }

        return view('user.support.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('user.support.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppMailer $mailer)
    {   
        request()->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
            'priority' => 'required|string',
            'category' => 'required|string',
        ]);

        $ticket_id = strtoupper(Str::random(10));

        $ticket = new SupportTicket([
            'subject' => htmlspecialchars(request('subject')),
            'priority' => htmlspecialchars(request('priority')),
            'category' => htmlspecialchars(request('category')),
            'status' => 'Open',
            'user_id' => Auth::user()->id,
            'ticket_id' => $ticket_id,
        ]); 

        $ticket->save();

        $message = new SupportMessage([
            'message' => htmlspecialchars(request('message')),
            'user_id' => Auth::user()->id,
            'role' => Auth::user()->group,
            'ticket_id' => $ticket_id,
        ]); 
               

        if (request()->has('attachment')) {
        
            try {
                request()->validate([
                    'attachment' => 'nullable|image|mimes:jpeg,png,jpg|max:20048'
                ]);
                
            } catch (\Exception $e) {
                toastr()->error(__('PHP FileInfo function is not enabled in your hosting, make sure to enable it first'));
                return redirect()->back();
            }
            
            $image = request()->file('attachment');

            $name = Str::random(10);
         
            $folder = '/uploads/img/support/';
          
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            
            $this->uploadImage($image, $folder, 'public', $name);

            $message->attachment = $filePath;

            $message->save();
        
        } else {
            $message->save();
        }
        
        if (config('settings.support_email') == 'enabled') {
			$mailer->sendSupportTicketInformation(Auth::user(), $ticket);
		}
        
        toastr()->success("Support ticket has been created successfully");
        return redirect()->route('user.support');
    }


    /**
     * Store response in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function response(AppMailer $mailer)
    {   
        request()->validate([
            'message' => 'required|string',
        ]);

        $ticket = SupportTicket::where('ticket_id', request('ticket_id'))->firstOrFail();
        $ticket->updated_at = now();
        $ticket->save();

        $message = new SupportMessage([
            'message' => htmlspecialchars(request('message')),
            'user_id' => Auth::user()->id,
            'role' => Auth::user()->group,
            'ticket_id' => request('ticket_id'),
        ]); 
               
        if (request()->has('attachment')) {
        
            try {
                request()->validate([
                    'attachment' => 'nullable|image|mimes:jpeg,png,jpg|max:5048'
                ]);
                
            } catch (\Exception $e) {
                toastr()->error(__('PHP FileInfo function is not enabled in your hosting, make sure to enable it first'));
                return redirect()->back();
            }
            
            $image = request()->file('attachment');

            $name = Str::random(10);
         
            $folder = '/uploads/img/support/';
          
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            
            $this->uploadImage($image, $folder, 'public', $name);

            $message->attachment = $filePath;

            $message->save();
        
        } else {
            $message->save();
        }
        
        if (config('settings.support_email') == 'enabled') {
			$mailer->sendSupportTicketInformation(Auth::user(), $ticket);
		}       

        return redirect()->route('user.support.show', request('ticket_id'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {   
        $ticket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();
        $messages = SupportMessage::where('ticket_id', $ticket_id)->get();

        if ($ticket->user_id == Auth::user()->id){

            return view('user.support.show', compact('ticket', 'messages'));     

        } else{
            return redirect()->route('user.support');
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

            $ticket = SupportTicket::where('ticket_id', request('id'))->firstOrFail();  

            if ($ticket->user_id == Auth::user()->id){

                $ticket->delete();

                SupportMessage::where('ticket_id', request('id'))->delete();

                return response()->json('success');   

            } else{
                return response()->json('error');
            } 
        } 
    }


    /**
     * Upload user profile image
     */
    public function uploadImage(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(10);

        $image = $file->storeAs($folder, $name .'.'. $file->getClientOriginalExtension(), $disk);

        return $image;
    }
}
