<?php

namespace App\Services\Statistics;

use Illuminate\Support\Facades\Auth;
use App\Models\Content;
use App\Models\Image;
use App\Models\VoiceoverResult;
use App\Models\Transcript;
use App\Models\Code;
use App\Models\User;
use DB;

class DavinciUsageService 
{
    private $month;
    private $year;

    public function __construct(int $month = null, int $year = null)
    {
        $this->month = $month;
        $this->year = $year;
    }


    /**
     * Total words usage per user id
     */
    public function userTotalWordsGenerated($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('user_id', $user_id)
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Current month total usage per user id
     */
    public function userTotalWordsGeneratedCurrentMonth($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('user_id', $user_id)
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Total words generated current year usage per user id
     */
    public function userTotalWordsGeneratedCurrentYear($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_content = Content::select(DB::raw("sum(tokens) as data"))
                ->where('user_id', $user_id)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_content[0]['data'];
    }


    public function userDailyWordsChart($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $users = Content::select(DB::raw("sum(tokens) as data"), DB::raw("DAY(created_at) day"))
                ->whereMonth('created_at', $this->month)
                ->where('user_id', $user_id)
                ->groupBy('day')
                ->orderBy('day')
                ->get()->toArray();  
        
        $data = [];

        for($i = 1; $i <= 31; $i++) {
            $data[$i] = 0;
        }

        foreach ($users as $row) {				            
            $month = $row['day'];
            $data[$month] = intval($row['data']);
        }
        
        return $data;
    }


    /**
     * Chart data - total usage during current year split by month by user id
     */
    public function userMonthlyWordsChart($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $words = Content::select(DB::raw("sum(tokens) as data"), DB::raw("MONTH(created_at) month"))
                ->whereYear('created_at', date('Y'))
                ->where('user_id', $user_id)
                ->groupBy('month')
                ->orderBy('month')
                ->get()->toArray();  
        
        $data = [];

        for($i = 1; $i <= 12; $i++) {
            $data[$i] = 0;
        }

        foreach ($words as $row) {				            
            $month = $row['month'];
            $data[$month] = intval($row['data']);
        }
        
        return $data;
    }


    /**
     * Total content usage per user id
     */
    public function userTotalContentsGenerated($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_content = Content::select(DB::raw("count(id) as data"))
                ->where('user_id', $user_id)
                ->get();  
        
        return $total_content[0]['data'];
    }


    /**
     * Current month total usage per user id
     */
    public function userTotalContentsGeneratedCurrentMonth($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_words = Content::select(DB::raw("count(id) as data"))
                ->where('user_id', $user_id)
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Current month total usage per user id
     */
    public function getTotalWordsCurrentMonth()
    {
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Current month total usage per user id
     */
    public function getTotalFreeWordsCurrentMonth()
    {
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->where('plan_type', 'free')
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Current month total usage per user id
     */
    public function getTotalPaidWordsCurrentMonth()
    {
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->where('plan_type', 'paid')
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Past month total usage per user id
     */
    public function getTotalWordsPastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth =  $date->subMonth()->format('m');

        $total_transfers = Content::select(DB::raw("sum(tokens) as data"))
                ->whereMonth('created_at', $pastMonth)
                ->whereYear('created_at', date('Y')) 
                ->get();  
        
        return $total_transfers[0]['data'];
    }


    /**
     * Current year total used by all users
     */
    public function getTotalWordsCurrentYear()
    {
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->whereYear('created_at', date('Y'))
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Current year total used by all users
     */
    public function getTotalFreeWordsCurrentYear()
    {
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->whereYear('created_at', date('Y'))
                ->where('plan_type', 'free')
                ->get();  
        
        return $total_words[0]['data'];
    }


     /**
     * Current year total used by all users
     */
    public function getTotalPaidWordsCurrentYear()
    {
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->whereYear('created_at', date('Y'))
                ->where('plan_type', 'paid')
                ->get();  
        
        return $total_words[0]['data'];
    }


    public function getDailyWordsChart()
    {
        $users = Content::select(DB::raw("sum(tokens) as data"), DB::raw("DAY(created_at) day"))
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', date('Y'))
                ->groupBy('day')
                ->orderBy('day')
                ->get()->toArray();  
        
        $data = [];

        for($i = 1; $i <= 31; $i++) {
            $data[$i] = 0;
        }

        foreach ($users as $row) {				            
            $month = $row['day'];
            $data[$month] = intval($row['data']);
        }
        
        return $data;
    }


    /**
     * Chart data - total usage during current year split by month by user id
     */
    public function getMonthlyWordsChart()
    {
        $words = Content::select(DB::raw("sum(tokens) as data"), DB::raw("MONTH(created_at) month"))
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get()->toArray();  
        
        $data = [];

        for($i = 1; $i <= 12; $i++) {
            $data[$i] = 0;
        }

        foreach ($words as $row) {				            
            $month = $row['month'];
            $data[$month] = intval($row['data']);
        }
        
        return $data;
    }


    /**
     * Total words usage per user id
     */
    public function userTotalImagesGenerated($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_words = Image::select(DB::raw("count(id) as data"))
                ->where('user_id', $user_id)
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Current month total usage per user id
     */
    public function userTotalImagesGeneratedCurrentMonth($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_words = Image::select(DB::raw("count(id) as data"))
                ->where('user_id', $user_id)
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Chart data - total usage during current year split by month by user id
     */
    public function userMonthlyImagesChart($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $words = Image::select(DB::raw("count(id) as data"), DB::raw("MONTH(created_at) month"))
                ->whereYear('created_at', date('Y'))
                ->where('user_id', $user_id)
                ->groupBy('month')
                ->orderBy('month')
                ->get()->toArray();  
        
        $data = [];

        for($i = 1; $i <= 12; $i++) {
            $data[$i] = 0;
        }

        foreach ($words as $row) {				            
            $month = $row['month'];
            $data[$month] = intval($row['data']);
        }
        
        return $data;
    }


    /**
     * Current month total usage per user id
     */
    public function getTotalImagesCurrentMonth()
    {
        $total_words = Image::select(DB::raw("count(id) as data"))
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Past month total usage per user id
     */
    public function getTotalImagesPastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth =  $date->subMonth()->format('m');

        $total_transfers = Image::select(DB::raw("count(id) as data"))
                ->whereMonth('created_at', $pastMonth)
                ->whereYear('created_at', date('Y')) 
                ->get();  
        
        return $total_transfers[0]['data'];
    }


    /**
     * Current year total used by all users
     */
    public function getTotalImagesCurrentYear()
    {
        $total_words = Image::select(DB::raw("count(id) as data"))
                ->whereYear('created_at', date('Y'))
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Total content usage per user id
     */
    public function getTotalContentsCurrentYear()
    {
        $total_content = Content::select(DB::raw("count(id) as data"))
                ->whereYear('created_at', date('Y'))
                ->get();  
        
        return $total_content[0]['data'];
    }


    /**
     * Current month total usage per user id
     */
    public function getTotalContentsCurrentMonth()
    {
        $total_words = Content::select(DB::raw("count(id) as data"))
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_words[0]['data'];
    }


    /**
     * Past month total usage per user id
     */
    public function getTotalContentsPastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth =  $date->subMonth()->format('m');

        $total_transfers = Content::select(DB::raw("count(id) as data"))
                ->whereMonth('created_at', $pastMonth)
                ->whereYear('created_at', date('Y')) 
                ->get();  
        
        return $total_transfers[0]['data'];
    }


    /**
     * Current month total usage per user id
     */
    public function userTotalSynthesizedTextCurrentMonth($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_voiceover = VoiceoverResult::select(DB::raw("count(id) as data"))
                ->where('user_id', $user_id)
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_voiceover[0]['data'];
    }

    /**
     * Total usage per user id
     */
    public function userTotalSynthesizedText($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_voiceover = VoiceoverResult::select(DB::raw("count(id) as data"))
                ->where('user_id', $user_id)
                ->get();  
        
        return $total_voiceover[0]['data'];
    }


    /**
     * Current month total usage per user id
     */
    public function userTotalTranscribedAudioCurrentMonth($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_voiceover = Transcript::select(DB::raw("count(id) as data"))
                ->where('user_id', $user_id)
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_voiceover[0]['data'];
    }

    /**
     * Total usage per user id
     */
    public function userTotalTranscribedAudio($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_voiceover = Transcript::select(DB::raw("count(id) as data"))
                ->where('user_id', $user_id)
                ->get();  
        
        return $total_voiceover[0]['data'];
    }


    /**
     * Current month total usage per user id
     */
    public function userTotalCodesCreatedCurrentMonth($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_voiceover = Code::select(DB::raw("count(id) as data"))
                ->where('user_id', $user_id)
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_voiceover[0]['data'];
    }

     /**
     * Total usage per user id
     */
    public function userTotalCodesCreated($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $total_voiceover = Code::select(DB::raw("count(id) as data"))
                ->where('user_id', $user_id)
                ->get();  
        
        return $total_voiceover[0]['data'];
    }


    /**
     * Total words generated 
     */
    public function teamTotalWordsGenerated()
    {
        $members = User::where('member_of', auth()->user()->id)->pluck('id');
        
        $content = Content::whereIn('user_id', $members)->select(DB::raw("sum(tokens) as data"))->get();    
        
        return $content[0]['data'];
    }


    /**
     * Total words generated 
     */
    public function teamTotalContentSaved()
    {
        $members = User::where('member_of', auth()->user()->id)->pluck('id');
        
        $content = Content::whereIn('user_id', $members)->select(DB::raw("count(id) as data"))->where('result_text','<>', null)->get();    
        
        return $content[0]['data'];
    }


    /**
     * Total words generated 
     */
    public function teamTotalImagesGenerated()
    {
        $members = User::where('member_of', auth()->user()->id)->pluck('id');
        
        $content = Image::whereIn('user_id', $members)->select(DB::raw("count(id) as data"))->get();    
        
        return $content[0]['data'];
    }


    /**
     * Total words generated 
     */
    public function teamTotalVoiceoverTasks()
    {
        $members = User::where('member_of', auth()->user()->id)->pluck('id');
        
        $content = VoiceoverResult::whereIn('user_id', $members)->select(DB::raw("count(id) as data"))->get();    
        
        return $content[0]['data'];
    }


    /**
     * Total words generated 
     */
    public function teamTotalCharsGenerated()
    {
        $members = User::where('member_of', auth()->user()->id)->pluck('id');
        
        $content = VoiceoverResult::whereIn('user_id', $members)->select(DB::raw("sum(characters) as data"))->get();    
        
        return $content[0]['data'];
    }


    /**
     * Total words generated 
     */
    public function teamTotalTranscribeTasks()
    {
        $members = User::where('member_of', auth()->user()->id)->pluck('id');
        
        $content = Transcript::whereIn('user_id', $members)->select(DB::raw("count(id) as data"))->get();    
        
        return $content[0]['data'];
    }


    public function teamWordsChart($user = null)
    {
        $members = User::where('member_of', auth()->user()->id)->pluck('id');

        $words = Content::whereIn('user_id', $members)->select(DB::raw("sum(tokens) as data"), DB::raw("MONTH(created_at) month"))
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get()->toArray();  
        
        $data = [];

        for($i = 1; $i <= 12; $i++) {
            $data[$i] = 0;
        }

        foreach ($words as $row) {				            
            $month = $row['month'];
            $data[$month] = intval($row['data']);
        }
        
        return $data;
    }

}