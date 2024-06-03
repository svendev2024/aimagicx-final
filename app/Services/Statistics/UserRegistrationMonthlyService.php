<?php

namespace App\Services\Statistics;

use App\Models\User;
use DB;

class UserRegistrationMonthlyService 
{
    private $month;

    public function __construct(int $month)
    {
        $this->month = $month;
    }


    public function getRegisteredUsers()
    {
        $users = User::select(DB::raw("count(id) as data"), DB::raw("DAY(created_at) day"))
                ->whereMonth('created_at', $this->month)
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







}