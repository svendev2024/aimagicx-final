<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Notifications\GeneralNotification;
use App\Models\User;
use DataTables;

class NotificationController extends Controller
{
    /**
     * Display all general notifications
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Auth::user()->notifications->where('type', 'App\Notifications\GeneralNotification')->all();;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                            <a href="'. route("admin.notifications.show", $row["id"] ). '"><i class="fa-solid fa-bell-exclamation table-action-buttons view-action-button" title="View Notification"></i></a>
                                            <a class="deleteNotificationButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Notification"></i></a> 
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'd M Y H:i:s').'</span>';
                        return $created_on;
                    })
                    ->addColumn('subject', function($row){
                        $created_on = $row["data"]["subject"];
                        return $created_on;
                    })
                    ->addColumn('user-action', function($row){
                        $user_action = '<span class="font-weight-bold">'.$row["data"]["action"].'</span>';
                        return $user_action;
                    })
                    ->addColumn('notification-type', function($row){
                        $notification = '<span class="cell-box notification-'.strtolower($row["data"]["type"]).'">'.$row["data"]["type"].'</span>';
                        return $notification;
                    })
                    ->rawColumns(['actions', 'notification-type', 'created-on', 'subject', 'user-action'])
                    ->make(true);
                    
        }

        return view('admin.notification.index');
    }


    /**
     * Display all system notifications
     */
    public function system(Request $request)
    {
        if ($request->ajax()) {
            $data = Auth::user()->notifications->where('type', '<>', 'App\Notifications\GeneralNotification')->all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                        <a href="'. route("admin.notifications.systemShow", $row["id"] ). '"><i class="fa-solid fa-bell table-action-buttons view-action-button" title="View Result"></i></a>
                                        <a class="deleteNotificationButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Result"></i></a> 
                                    </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'd M Y H:i:s').'</span>';
                        return $created_on;
                    })
                    ->addColumn('read-on', function($row){
                        if (!is_null($row["read_at"])) {
                            $read_on = '<span>'.date_format($row["read_at"], 'd M Y H:i:s').'</span>';
                            return $read_on;
                        } else {
                            return '<span>'.$row["read_at"].'</span>';
                        }
                        
                    })
                    ->addColumn('subject', function($row){
                        $created_on = '<span>'.$row["data"]["subject"].'</span>';
                        return $created_on;
                    })  
                    ->addColumn('email', function($row){
                        $email = '<span class="font-weight-bold">'.$row["data"]["email"].'</span>';
                        return $email;
                    })  
                    ->addColumn('country', function($row){
                        $country = '<span>'.$row["data"]["country"].'</span>';
                        return $country;
                    })                   
                    ->addColumn('notification-type', function($row){
                        if ($row["data"]["type"] == "new-user") {
                            $type = "New User";
                        } elseif($row["data"]["type"] == "new-payment") {
                            $type = "New Payment";
                        } elseif($row["data"]["type"] == "payout-request") {
                            $type = "New Payout Request";
                        }
                        $notification = '<span class="cell-box notification-'.strtolower($row["data"]["type"]).'">'.$type.'</span>';
                        return $notification;
                    })
                    ->rawColumns(['actions', 'notification-type', 'created-on', 'subject', 'read-on', 'email', 'country'])
                    ->make(true);
                    
        }

        return view('admin.notification.system');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification.create');
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
            'notification-type' => 'required|string',
            'notification-action' => 'required|string',
            'notification-subject' => 'required|string',
            'notification-message' => 'required|string',
        ]);

        $notification = [
            'type' => htmlspecialchars(request('notification-type')),
            'action' => htmlspecialchars(request('notification-action')),
            'subject' => htmlspecialchars(request('notification-subject')),
            'message' => htmlspecialchars(request('notification-message')),
        ];
            
        $users = User::all();

        Notification::send($users, new GeneralNotification($notification));  

        toastr()->success(__('New notification has been created successfully'));
        return redirect()->route('admin.notifications');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if($notification) {
            $notification->markAsRead();
        }
        
        return view('admin.notification.show', compact('notification'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function systemShow($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if($notification) {
            $notification->markAsRead();
        }
        
        return view('admin.notification.systemShow', compact('notification'));
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

            $notification = auth()->user()->notifications()->find(request('id'));

            if($notification) {

                $notification->delete();

                return response()->json('success');

            } else{
                return response()->json('error');
            } 
        } 
    }

    
    /**
     * Mark all notifications as read
     */
    public function markAllRead()
    {
        $notifications = auth()->user()->unreadNotifications->where('type', '<>', 'App\Notifications\GeneralNotification');

        foreach($notifications as $notification) {
            $notification->markAsRead();
        }        

        toastr()->success(__('All system notifications are marked as read'));
        return redirect()->route('admin.notifications.system');
    }


    /**
     * Delete all notifications
     */
    public function deleteAll()
    {
        $notifications = auth()->user()->notifications->where('type', '<>', 'App\Notifications\GeneralNotification');
        
        foreach($notifications as $notification) {
            $notification->delete();
        }          

        toastr()->success(__('All system notifications are deleted successfully'));
        return redirect()->route('admin.notifications.system');
    }
}
