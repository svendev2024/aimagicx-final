<?php

namespace App\Services\Statistics;
use App\Models\Content;
use DB;

class CostsService 
{
    private $year;
    private $month;

    public function __construct(int $year = null, int $month = null) 
    {
        $this->year = $year;
        $this->month = $month;
    }


    public function getTotalDavinciPastMonth()
    {   
        $date = \Carbon\Carbon::now();
        $pastMonth =  $date->subMonth()->format('m');

        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-davinci-003')
                ->whereMonth('created_at', $pastMonth)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        $total = ($total_words[0]['data']/1000) * 0.02;
        return $total;
    }


    public function getTotalDavinciCostCurrentMonth()
    {   
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-davinci-003')
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        $total = ($total_words[0]['data']/1000) * 0.02;
        return $total;
    }


    public function getTotalDavinciCostCurrentYear()
    {   
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-davinci-003')
                ->whereYear('created_at', $this->year)
                ->get();  

        $total = ($total_words[0]['data']/1000) * 0.02;
        return $total;
    }

    
    public function getTotalCuriePastMonth()
    {   
        $date = \Carbon\Carbon::now();
        $pastMonth =  $date->subMonth()->format('m');

        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-curie-001')
                ->whereMonth('created_at', $pastMonth)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        $total = ($total_words[0]['data']/1000) * 0.002;
        return $total;
    }


    public function getTotalCurieCostCurrentMonth()
    {   
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-curie-001')
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  

        $total = ($total_words[0]['data']/1000) * 0.002;
        return $total;
    }


    public function getTotalCurieCostCurrentYear()
    {   
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-curie-001')
                ->whereYear('created_at', $this->year)
                ->get();  

        $total = ($total_words[0]['data']/1000) * 0.002;
        return $total;
    }


    public function getTotalBabbagePastMonth()
    {   
        $date = \Carbon\Carbon::now();
        $pastMonth =  $date->subMonth()->format('m');

        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-babbage-001')
                ->whereMonth('created_at', $pastMonth)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        $total = ($total_words[0]['data']/1000) * 0.0005;
        return $total;
    }


    public function getTotalBabbageCostCurrentMonth()
    {   
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-babbage-001')
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  

        $total = ($total_words[0]['data']/1000) * 0.0005;
        return $total;
    }


    public function getTotalBabbageCostCurrentYear()
    {   
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-babbage-001')
                ->whereYear('created_at', $this->year)
                ->get();  

        $total = ($total_words[0]['data']/1000) * 0.0005;
        return $total;
    }


    public function getTotalAdaPastMonth()
    {   
        $date = \Carbon\Carbon::now();
        $pastMonth =  $date->subMonth()->format('m');

        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-ada-001')
                ->whereMonth('created_at', $pastMonth)
                ->whereYear('created_at', $this->year)
                ->get();  
        
        $total = ($total_words[0]['data']/1000) * 0.0004;
        return $total;
    }


    public function getTotalAdaCostCurrentMonth()
    {   
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-ada-001')
                ->whereMonth('created_at', $this->month)
                ->whereYear('created_at', $this->year)
                ->get();  

        $total = ($total_words[0]['data']/1000) * 0.0004;
        return $total;
    }


    public function getTotalAdaCostCurrentYear()
    {   
        $total_words = Content::select(DB::raw("sum(tokens) as data"))
                ->where('model', 'text-ada-001')
                ->whereYear('created_at', $this->year)
                ->get();  

        $total = ($total_words[0]['data']/1000) * 0.0004;
        return $total;
    }

}