<?php

namespace App\Services\Statistics;

use App\Models\User;
use DB;

class UserRegistrationYearlyService 
{
    private $year;

    public function __construct(int $year)
    {
        $this->year = $year;
    }
    

    public function getFreeRegistrations()
    {
        $users = User::select(DB::raw("count(id) as data"), DB::raw("MONTH(created_at) month"))
                ->whereYear('created_at', $this->year)
                ->where(function($query){
                    $query->where('group', 'user')
                          ->orWhere('group', 'admin');
                })                 
                ->groupBy('month')
                ->orderBy('month')
                ->get()->toArray();  
        
        $data = [];

        for($i = 1; $i <= 12; $i++) {
            $data[$i] = 0;
        }

        foreach ($users as $row) {				            
            $month = $row['month'];
            $data[$month] = intval($row['data']);
        }
        
        return $data;
    }


    public function getTotalFreeRegistrations()
    {
        $total_users = User::select(DB::raw("count(id) as data"))
                ->whereYear('created_at', $this->year)
                ->where('group', 'user')
                ->get();  
        
        return $total_users;
    }


    public function getTotalUsers()
    {
        $total_users = User::select(DB::raw("count(id) as data"))->get();  
        
        return $total_users;
    }

}