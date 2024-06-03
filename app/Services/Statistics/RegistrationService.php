<?php

namespace App\Services\Statistics;

use App\Models\User;
use DB;

class RegistrationService 
{
    private $year;
    private $month;

    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
    }


    public function getAllUsers()
    {
        $users = User::select(DB::raw("count(id) as data"), DB::raw("MONTH(created_at) month"))
                ->whereYear('created_at', $this->year)               
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


    public function getNewUsersCurrentMonth()
    {
        $total_users = User::select(DB::raw("count(id) as data"))
                ->whereMonth('created_at', $this->month)
                ->get();  
        
        return $total_users[0]['data'];
    }


    public function getNewUsersPastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth =  $date->subMonth()->format('m');

        $total_users = User::select(DB::raw("count(id) as data"))
                ->whereMonth('created_at', $pastMonth)
                ->get();  
        
        return $total_users[0]['data'];
    }


    public function getNewUsersCurrentYear()
    {
        $total_users = User::select(DB::raw("count(id) as data"))
                ->whereYear('created_at', $this->year)
                ->get();  
        
        return $total_users[0]['data'];
    }


    public function getNewSubscribersCurrentMonth()
    {
        $total_users = User::select(DB::raw("count(id) as data"))
                ->whereMonth('created_at', $this->month)
                ->where('group', 'subscriber')
                ->get();  
        
        return $total_users[0]['data'];
    }


    public function getNewSubscribersPastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth =  $date->subMonth()->format('m');

        $total_users = User::select(DB::raw("count(id) as data"))
                ->whereMonth('created_at', $pastMonth)
                ->where('group', 'subscriber')
                ->get();  
        
        return $total_users[0]['data'];
    }

    public function getNewSubscribersCurrentYear()
    {
        $total_users = User::select(DB::raw("count(id) as data"))
                ->whereYear('created_at', $this->year)
                ->where('group', 'subscriber')
                ->get();  
        
        return $total_users[0]['data'];
    }

}