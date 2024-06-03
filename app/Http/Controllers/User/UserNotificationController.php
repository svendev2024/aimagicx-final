<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;

class UserNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Auth::user()->notifications->where('type', 'App\Notifications\GeneralNotification')->all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>
                                        <a href="'. route("user.notifications.show", $row["id"] ). '"><i class="fa-solid fa-bell-exclamation table-action-buttons view-action-button" title="View Notification"></i></a>
                                        <a class="deleteNotificationButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Notification"></i></a> 
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
                    ->addColumn('message', function($row){
                        $message = '<span>'.$row["data"]["message"].'</span>';
                        return $message;
                    })
                    ->addColumn('subject', function($row){
                        $created_on = $row["data"]["subject"];
                        return $created_on;
                    })
                    ->addColumn('sender', function($row){
                        $sender = '<span>'.ucfirst($row["data"]["sender"]).'</span>';
                        return $sender;
                    })
                    ->addColumn('notification-type', function($row){                    
                        $notification = '<span class="cell-box notification-'.strtolower($row["data"]["type"]).'">'.$row["data"]["type"].'</span>';
                        return $notification;
                    })
                    ->addColumn('user-action', function($row){
                        $user_action = '<span class="font-weight-bold">'.$row["data"]["action"].'</span>';
                        return $user_action;
                    })
                    ->rawColumns(['actions', 'created-on', 'message', 'subject', 'sender', 'notification-type', 'user-action', 'read-on'])
                    ->make(true);
                    
        }

        return view('user.notification.index');
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
        
        return view('user.notification.show', compact('notification'));   
    }


    /**
     * Remove the specified notification.
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
        auth()->user()->unreadNotifications->markAsRead();

        toastr()->success(__('All notifications are marked as read'));
        return redirect()->route('user.notifications');
    }


    /**
     * Delete all notifications
     */
    public function deleteAll()
    {
        auth()->user()->notifications()->delete();

        toastr()->success(__('All notifications are deleted'));
        return redirect()->route('user.notifications');
    }


    /**
     * Mark a notification as read
     */
    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
}
