<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Services\Statistics\SupportService;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use App\Models\User;
use App\Mailers\AppMailer;
use Carbon\Carbon;
use DataTables;
use DateTime;


class SupportController extends Controller
{
    /**
     * Display all support cases
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SupportTicket::all()->sortByDesc("created_at");
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                        <a href="'. route("admin.support.show", $row["ticket_id"] ). '"><i class="fa-solid fa-message-question table-action-buttons view-action-button" title="View Support Ticket"></i></a>
                                        <a class="deleteNotificationButton" id="'. $row["ticket_id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Support Ticket"></i></a> 
                                    </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'd M Y H:i:s').'</span>';
                        return $created_on;
                    })
                    ->addColumn('resolved-on', function($row){
                        if (!is_null($row['resolved_on'])) {
                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $row['resolved_on']);
                            $updated_on = '<span>'.date_format($date, 'd M Y H:i:s').'</span>';
                            return $updated_on;
                        } else {
                            return '';
                        }
                        
                    })
                    ->addColumn('custom-status', function($row){
                        $custom_status = '<span class="cell-box support-'.strtolower($row["status"]).'">'.__($row["status"]).'</span>';
                        return $custom_status;
                    })
                    ->addColumn('custom-priority', function($row){
                        $custom_priority = '<span class="cell-box priority-'.strtolower($row["priority"]).'">'.__($row["priority"]).'</span>';
                        return $custom_priority;
                    })
                    ->addColumn('username', function($row){
                        $username = '<span class="font-weight-bold">'.User::find($row["user_id"])->name.'</span><br><span class="text-muted">'.User::find($row["user_id"])->email.'</span>';
                        return $username;
                    })
                    ->addColumn('custom-category', function($row){
                        $custom_priority = '<span class="font-weight-bold">'.$row["category"].'</span>';
                        return $custom_priority;
                    })
                    ->addColumn('custom-ticket', function($row){
                        $custom_priority = '<a class="font-weight-bold text-primary" href="'. route("admin.support.show", $row["ticket_id"] ). '">'.$row["ticket_id"].'</a>';
                        return $custom_priority;
                    })
                    ->addColumn('custom-subject', function($row){
                        $custom_priority = '<a class="support-subject-text" href="'. route("admin.support.show", $row["ticket_id"] ). '">'.$row["subject"].'</a>';
                        return $custom_priority;
                    })
                    ->rawColumns(['actions', 'custom-status', 'created-on', 'custom-priority', 'username', 'resolved-on', 'custom-category', 'custom-ticket', 'custom-subject'])
                    ->make(true);
                    
        }

        $support = new SupportService();

        $open = $support->getOpenTickets();
        $replied = $support->getRepliedTickets();
        $pending = $support->getPendingTickets();
        $resolved = $support->getResolvedTickets();
        $closed = $support->getClosedTickets();

        return view('admin.support.index', compact('open', 'replied', 'pending', 'resolved', 'closed'));
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

        return view('admin.support.show', compact('ticket', 'messages'));     
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
            'response-status' => 'required',
        ]);

        if (request('response-status') == 'Closed' || request('response-status') == 'Resolved') {
            $resolved_on = now();
            $notify = true;
        } else {
            $resolved_on = null;
            $notify = false;
        }

        $ticket = SupportTicket::where('ticket_id', request('ticket_id'))->firstOrFail();
        $ticket->status = request('response-status');
        $ticket->resolved_on = $resolved_on;
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

        if ($notify) {
            $user = User::find($ticket->user_id);
            $mailer->sendSupportTicketStatusNotification($user, $ticket);
        } 
        
        if (config('settings.support_email') == 'enabled') {
			$mailer->sendSupportTicketInformation(Auth::user(), $ticket);
		}       

        return redirect()->route('admin.support.show', request('ticket_id'));
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

            if ($ticket){

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
