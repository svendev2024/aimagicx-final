<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Services\Statistics\UserRegistrationYearlyService;
use App\Services\Statistics\UserRegistrationMonthlyService;
use App\Services\Statistics\DavinciUsageService;
use App\Models\SubscriptionPlan;
use App\Models\VoiceoverResult;
use App\Models\Transcript;
use App\Models\Subscriber;
use App\Models\Content;
use App\Models\Image;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Cache;


class TeamController extends Controller
{
    /**
     * Display user management dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));

        $davinci_usage = new DavinciUsageService($month, $year);

        $data = [
            'words' => $davinci_usage->teamTotalWordsGenerated(),
            'contents' => $davinci_usage->teamTotalContentSaved(),
            'images' => $davinci_usage->teamTotalImagesGenerated(),
            'synthesized' => $davinci_usage->teamTotalVoiceoverTasks(),
            'transcribed' => $davinci_usage->teamTotalTranscribeTasks(),
            'chars' => $davinci_usage->teamTotalCharsGenerated(),
        ];

        if (is_null(auth()->user()->member_of)) {
            $member = false;
            $user_name = '';
        } else {
            $member = true;
            $user = User::where('id', auth()->user()->member_of)->first();
            $user_name = $user->name;
        }

        $count = User::where('member_of', auth()->user()->id)->count();

        $chart_data['team_usage'] = json_encode($davinci_usage->teamWordsChart());

        return view('user.team.index', compact('data', 'chart_data', 'count', 'member', 'user_name'));
    }


    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function listUsers(Request $request)
    {  
        if ($request->ajax()) {

            if (is_null(auth()->user()->member_of)) {
                $data = User::where('member_of', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('actions', function($row){
                            $actionBtn ='<div>
                                            <a href="'. route("user.team.show", $row["id"] ). '"><i class="fa-solid fa-clipboard-user table-action-buttons view-action-button" title="View Team Member"></i></a>
                                            <a href="'. route("user.team.edit", $row["id"] ). '"><i class="fa-solid fa-user-pen table-action-buttons edit-action-button" title="Edit Team Member"></i></a>
                                            <a class="deleteUserButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-user-slash table-action-buttons delete-action-button" title="Remove Team Member"></i></a>
                                        </div>';
                            return $actionBtn;
                        })
                        ->addColumn('user', function($row){
                            if ($row['profile_photo_path']) {
                                $path = asset($row['profile_photo_path']);
                                $user = '<div class="d-flex">
                                        <div class="widget-user-image-sm overflow-hidden mr-4"><img alt="Avatar" src="' . $path . '"></div>
                                        <div class="widget-user-name"><span class="font-weight-bold">'. $row['name'] .'</span> <br> <span class="text-muted">'.$row["email"].'</span></div>
                                    </div>';
                            } else {
                                $path = URL::asset('img/users/avatar.png');
                                $user = '<div class="d-flex">
                                        <div class="widget-user-image-sm overflow-hidden mr-4"><img alt="Avatar" class="rounded-circle" src="' . $path . '"></div>
                                        <div class="widget-user-name"><span class="font-weight-bold">'. $row['name'] .'</span> <br> <span class="text-muted">'.$row["email"].'</span></div>
                                    </div>';
                            }
                            
                            return $user;
                        })
                        ->addColumn('created-on', function($row){
                            $created_on = '<span class="font-weight-bold">'.date_format($row["created_at"], 'd M Y').'</span><br><span>'.date_format($row["created_at"], 'H:i A').'</span>';
                            return $created_on;
                        })
                        ->addColumn('custom-status', function($row){
                            $custom_status = '<span class="cell-box user-'.$row["status"].'">'.ucfirst($row["status"]).'</span>';
                            return $custom_status;
                        })
                        ->addColumn('words-used', function($row){
                            $used = '<span class="font-weight-bold">'.$this->wordsUsed($row['id']).'</span>';
                            return $used;
                        })
                        ->addColumn('images-used', function($row){
                            $used = '<span class="font-weight-bold">'.$this->imagesUsed($row['id']).'</span>';
                            return $used;
                        })
                        ->addColumn('chars-used', function($row){
                            $used = '<span class="font-weight-bold">'.$this->charsUsed($row['id']).'</span>';
                            return $used;
                        })
                        ->addColumn('minutes-used', function($row){
                            $used = '<span class="font-weight-bold">'.$this->minutesUsed($row['id']).'</span>';
                            return $used;
                        })
                        ->rawColumns(['actions', 'custom-status', 'created-on', 'user', 'words-used', 'images-used', 'chars-used', 'minutes-used'])
                        ->make(true);  
            } else {

                $data = User::where('member_of', auth()->user()->member_of)->orWhere('id', auth()->user()->member_of)->orderBy('created_at', 'DESC')->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('actions', function($row){
                            $actionBtn ='<div>
                                            <a href="'. route("user.team.show", $row["id"] ). '"><i class="fa-solid fa-clipboard-user table-action-buttons view-action-button" title="View Team Member"></i></a>
                                            <a href="'. route("user.team.edit", $row["id"] ). '"><i class="fa-solid fa-user-pen table-action-buttons edit-action-button" title="Edit Team Member"></i></a>
                                            <a class="deleteUserButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-user-slash table-action-buttons delete-action-button" title="Delete Team Member"></i></a>
                                        </div>';
                            return $actionBtn;
                        })
                        ->addColumn('user', function($row){
                            if ($row['profile_photo_path']) {
                                $path = asset($row['profile_photo_path']);
                                $user = '<div class="d-flex">
                                        <div class="widget-user-image-sm overflow-hidden mr-4"><img alt="Avatar" src="' . $path . '"></div>
                                        <div class="widget-user-name"><span class="font-weight-bold">'. $row['name'] .'</span> <br> <span class="text-muted">'.$row["email"].'</span></div>
                                    </div>';
                            } else {
                                $path = URL::asset('img/users/avatar.png');
                                $user = '<div class="d-flex">
                                        <div class="widget-user-image-sm overflow-hidden mr-4"><img alt="Avatar" class="rounded-circle" src="' . $path . '"></div>
                                        <div class="widget-user-name"><span class="font-weight-bold">'. $row['name'] .'</span> <br> <span class="text-muted">'.$row["email"].'</span></div>
                                    </div>';
                            }
                            
                            return $user;
                        })
                        ->addColumn('created-on', function($row){
                            $created_on = '<span class="font-weight-bold">'.date_format($row["created_at"], 'd M Y').'</span><br><span>'.date_format($row["created_at"], 'H:i A').'</span>';
                            return $created_on;
                        })
                        ->addColumn('custom-status', function($row){
                            $custom_status = '<span class="cell-box user-'.$row["status"].'">'.ucfirst($row["status"]).'</span>';
                            return $custom_status;
                        })
                        ->addColumn('words-used', function($row){
                            $used = '<span class="font-weight-bold">'.$this->wordsUsed($row['id']).'</span>';
                            return $used;
                        })
                        ->addColumn('images-used', function($row){
                            $used = '<span class="font-weight-bold">'.$this->imagesUsed($row['id']).'</span>';
                            return $used;
                        })
                        ->addColumn('chars-used', function($row){
                            $used = '<span class="font-weight-bold">'.$this->charsUsed($row['id']).'</span>';
                            return $used;
                        })
                        ->addColumn('minutes-used', function($row){
                            $used = '<span class="font-weight-bold">'.$this->minutesUsed($row['id']).'</span>';
                            return $used;
                        })
                        ->rawColumns(['actions', 'custom-status', 'created-on', 'user', 'words-used', 'images-used', 'chars-used', 'minutes-used'])
                        ->make(true);   
            }                 
        }

    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.team.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
        ]);

        $template = (isset($request->template)) ? true : false;
        $chat = (isset($request->chat)) ? true : false;
        $code = (isset($request->code)) ? true : false;
        $voiceover = (isset($request->voiceover)) ? true : false;
        $image = (isset($request->image)) ? true : false;
        $speech = (isset($request->speech)) ? true : false;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'job_role' => $request->job_role,
            'phone_number' => $request->phone_number,
            'company' => $request->company,
            'website' => $request->website,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'member_use_credits_template' => $template, 
            'member_use_credits_chat' => $chat,
            'member_use_credits_code' => $code,
            'member_use_credits_voiceover' => $voiceover,
            'member_use_credits_speech' => $speech,
            'member_use_credits_image' => $image,
        ]);       
        
        $user->syncRoles('user');
        $user->status = 'active';
        $user->group = 'user';
        $user->email_verified_at = now();
        $user->referral_id = strtoupper(Str::random(15));
        $user->available_words = config('settings.free_tier_words');
        $user->available_images = config('settings.free_tier_images');
        $user->available_chars_prepaid = config('settings.voiceover_welcome_chars');
        $user->available_minutes_prepaid = config('settings.whisper_welcome_minutes');
        $user->default_voiceover_language = config('settings.voiceover_default_language');
        $user->default_voiceover_voice = config('settings.voiceover_default_voice');
        $user->member_of = auth()->user()->id;

        $members = User::where('member_of', auth()->user()->id)->count();

        if (is_null(auth()->user()->plan_id)) {
            if (config('settings.team_members_quantity_user') <= $members) {
                $user->delete();
                toastr()->warning(__('You have reached maximum allowed number of team members, subscribe to add more team members'));
                return redirect()->back();

            } else {
                $user->save();  
                toastr()->success(__('Congratulation! New Team Member has been created'));
                return redirect()->back();
            }
        } else {
            $plan = SubscriptionPlan::where('id', auth()->user()->plan_id)->first();

            if ($plan->team_members <= $members) {
                $user->delete();
                toastr()->warning(__('You have reached maximum allowed number of team members for your subscription plan'));
                return redirect()->back();
            } else {
                $user->save();  
                toastr()->success(__('Congratulation! New Team Member has been created'));
                return redirect()->back();
            }
        }
        
        
    }


    /**
     * Display the details of selected user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {   
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));

        $davinci = new DavinciUsageService($month, $year);

        $data = [
            'words' => $davinci->userTotalWordsGenerated($user->id),
            'images' => $davinci->userTotalImagesGenerated($user->id),
        ];
        
        $chart_data['word_usage'] = json_encode($davinci->userMonthlyWordsChart($user->id));
        
        $subscription = Subscriber::where('status', 'Active')->where('user_id', $user->id)->first();
        if ($subscription) {
             if(Carbon::parse($subscription->active_until)->isPast()) {
                 $subscription = false;
             } 
        } else {
            $subscription = false;
        }

        $user_subscription = ($subscription) ? SubscriptionPlan::where('id', $user->plan_id)->first() : '';
        
        $progress = [
            'words' => ($user->total_words > 0) ? (($user->available_words / $user->total_words) * 100) : 0,
        ];

        return view('user.team.show', compact('user', 'data', 'chart_data', 'user_subscription', 'progress', 'subscription'));
    }


    /**
     * Show the form for editing the specified user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.team.edit', compact('user'));
    }


    /**
     * Update selected user data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $template = (isset($request->template)) ? true : false;
        $chat = (isset($request->chat)) ? true : false;
        $code = (isset($request->code)) ? true : false;
        $voiceover = (isset($request->voiceover)) ? true : false;
        $image = (isset($request->image)) ? true : false;
        $speech = (isset($request->speech)) ? true : false;

        $user->update(request()->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($user)],
            'job_role' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'phone_number' => 'nullable|max:20',
            'address' => 'nullable|string|max:255',            
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'country' => 'string|max:255',
        ]));

        $user->member_use_credits_template = $template;
        $user->member_use_credits_chat = $chat;
        $user->member_use_credits_code = $code;
        $user->member_use_credits_voiceover = $voiceover;
        $user->member_use_credits_speech = $speech;
        $user->member_use_credits_image = $image;
        $user->save();

        
        toastr()->success(__('Team member information was successfully updated'));
        return redirect()->back();
    }


    /**
     * Delete selected user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {

            $user = User::find(request('id'));

            if($user) {

                $user->member_of = null;
                $user->save();

                return response()->json('success');

            } else{
                return response()->json('error');
            } 
        }     
    }


    /**
     * Team leave.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function leave(Request $request)
    {
        if ($request->ajax()) {

            $user = User::find(auth()->user()->id);

            if($user) {

                $user->member_of = null;
                $user->save();

                return response()->json('success');

            } else{
                return response()->json('error');
            } 
        }     
    }


    /**
     * Count words
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wordsUsed($id) 
    {
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
        ->where('user_id', $id)
        ->get();  

        return (is_null($total_words[0]['data'])) ? 0 : $total_words[0]['data'];
    }


    /**
     * Count images
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imagesUsed($id) 
    {
        $total_images = Image::select(DB::raw("count(id) as data"))
        ->where('user_id', $id)
        ->get();  

        return (is_null($total_images[0]['data'])) ? 0 : $total_images[0]['data'];
    }


    /**
     * Count chars
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function charsUsed($id) 
    {
        $total_chars = VoiceoverResult::select(DB::raw("sum(characters) as data"))
        ->where('user_id', $id)
        ->get();  

        return (is_null($total_chars[0]['data'])) ? 0 : $total_chars[0]['data'];
    }


    /**
     * Count chars
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function minutesUsed($id) 
    {
        $total_transcript = Transcript::select(DB::raw("sum(length) as data"))
        ->where('user_id', $id)
        ->get();  

        return (is_null($total_transcript[0]['data'])) ? 0 : $total_transcript[0]['data'];
    }

}   
