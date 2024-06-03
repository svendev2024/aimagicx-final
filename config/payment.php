<?php

return [

    /*
    |--------------------------------------------------------------------------
    | General Payment Settings
    |--------------------------------------------------------------------------
    */

    'payment_tax' => env('PAYMENT_TAX'), 

    'decimal_points' => env('DECIMAL_POINTS'), 

    'default_system_currency' => env('DEFAULT_SYSTEM_CURRENCY', 'USD'),  
    
    'default_system_currency_symbol' => env('DEFAULT_SYSTEM_CURRENCY_SYMBOL', '&#36;'),  

    'default_invoice_currency' => env('DEFAULT_INVOICE_CURRENCY', 'USD'),  

    'referral' => [
        'enabled' => env('REFERRAL_SYSTEM_ENABLE'),
        'payment' => [
            'policy' => env('REFERRAL_USER_PAYMENT_POLICY'), 
            'commission' => env('REFERRAL_USER_PAYMENT_COMMISSION'), 
            'threshold' => env('REFERRAL_USER_PAYMENT_THRESHOLD'), 
        ],
    ],   

];
