<?php

namespace App\Services\Statistics;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use DB;
 
class UserPaymentsService 
{
    private $year;

    public function __construct(int $year)
    {
        $this->year = $year;
    }


    public function getPayments($user = null)
    {
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $payments = Payment::select(DB::raw("sum(price) as data"), DB::raw("MONTH(created_at) month"))
                ->whereYear('created_at', $this->year)
                ->where('user_id', $user_id)
                ->where('status', 'Success')
                ->groupBy('month')
                ->orderBy('month')
                ->get()->toArray();  
        
        $data = [];

        for($i = 1; $i <= 12; $i++) {
            $data[$i] = 0;
        }

        foreach ($payments as $row) {				            
            $month = $row['month'];
            $data[$month] = intval($row['data']);
        }
        
        return $data;
    }


    public function getTotalPayments($user = null)
    {   
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $payments = Payment::select(DB::raw("sum(price) as data"))
                ->whereYear('created_at', $this->year)
                ->where('user_id', $user_id)
                ->where('status', 'Success')
                ->get();  
        
        return $payments;
    }


    public function getTotalPurchasedCharacters($user = null)
    {   
        $user_id = (is_null($user)) ? Auth::user()->id : $user;

        $payments = Payment::select(DB::raw("sum(characters) as data"))
                ->where('user_id', $user_id)
                ->where('status', 'Success')
                ->get();  
        
        return $payments;
    }

    

}