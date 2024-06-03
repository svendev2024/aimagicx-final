<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Services\Statistics\DavinciUsageService;
use App\Models\FavoriteTemplate;
use App\Models\CustomTemplate;
use App\Models\Template;
use App\Models\SubscriptionPlan;
use App\Models\Chat;
use App\Models\FavoriteChat;

class UserDashboardController extends Controller
{
    use Notifiable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                         
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));

        $davinci_usage = new DavinciUsageService($month, $year);

        $data = [
            'words' => $davinci_usage->userTotalWordsGeneratedCurrentMonth(),
            'contents' => $davinci_usage->userTotalContentsGeneratedCurrentMonth(),
            'images' => $davinci_usage->userTotalImagesGeneratedCurrentMonth(),
            'synthesized' => $davinci_usage->userTotalSynthesizedTextCurrentMonth(),
            'transcribed' => $davinci_usage->userTotalTranscribedAudioCurrentMonth(),
            'codes' => $davinci_usage->userTotalCodesCreatedCurrentMonth(),
        ];

        $chart_data['user_monthly_usage'] = json_encode($davinci_usage->userDailyWordsChart());

        $template_quantity = FavoriteTemplate::where('user_id', auth()->user()->id)->count();
        $templates = Template::select('templates.*', 'favorite_templates.*')->where('favorite_templates.user_id', auth()->user()->id)->join('favorite_templates', 'favorite_templates.template_code', '=', 'templates.template_code')->where('status', true)->orderBy('professional', 'asc')->get();       
        $custom_templates = CustomTemplate::select('custom_templates.*', 'favorite_templates.*')->where('favorite_templates.user_id', auth()->user()->id)->join('favorite_templates', 'favorite_templates.template_code', '=', 'custom_templates.template_code')->where('status', true)->orderBy('professional', 'asc')->get();    
        
        $chat_quantity = FavoriteChat::where('user_id', auth()->user()->id)->count();
        $favorite_chats = Chat::select('chats.*', 'favorite_chats.*')->where('favorite_chats.user_id', auth()->user()->id)->join('favorite_chats', 'favorite_chats.chat_code', '=', 'chats.chat_code')->where('status', true)->orderBy('category', 'asc')->get();       

        $plan = (auth()->user()->plan_id) ? SubscriptionPlan::where('id', auth()->user()->plan_id)->first() : '';
        $subscription = ($plan) ? $plan->plan_name : ''; 

        return view('user.dashboard.index', compact('data', 'chart_data', 'template_quantity', 'templates', 'subscription', 'custom_templates', 'chat_quantity', 'favorite_chats'));           
    }


    /**
	*
	* Set favorite status
	* @param - file id in DB
	* @return - confirmation
	*
	*/
	public function favorite(Request $request) 
    {
        if ($request->ajax()) {

            $template = Template::where('template_code', request('id'))->first(); 

            $favorite = FavoriteTemplate::where('template_code', $template->template_code)->where('user_id', auth()->user()->id)->first();

            if ($favorite) {

                $favorite->delete();

                $data['status'] = 'success';
                $data['set'] = true;
                return $data;  
    
            } else{

                $new_favorite = new FavoriteTemplate();
                $new_favorite->user_id = auth()->user()->id;
                $new_favorite->template_code = $template->template_code;
                $new_favorite->save();

                $data['status'] = 'success';
                $data['set'] = false;
                return $data; 
            }  
        }
	}


    
    /**
	*
	* Set favorite status
	* @param - file id in DB
	* @return - confirmation
	*
	*/
	public function favoriteCustom(Request $request) 
    {
        if ($request->ajax()) {

            $template = CustomTemplate::where('template_code', request('id'))->first(); 

            $favorite = FavoriteTemplate::where('template_code', $template->template_code)->where('user_id', auth()->user()->id)->first();

            if ($favorite) {

                $favorite->delete();

                $data['status'] = 'success';
                $data['set'] = true;
                return $data;  
    
            } else{

                $new_favorite = new FavoriteTemplate();
                $new_favorite->user_id = auth()->user()->id;
                $new_favorite->template_code = $template->template_code;
                $new_favorite->save();

                $data['status'] = 'success';
                $data['set'] = false;
                return $data; 
            }  
        }
	}


}
