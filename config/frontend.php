<?php

return [

    /*
    |--------------------------------------------------------------------------
    | General Settings
    |--------------------------------------------------------------------------
    */

    'maintenance' => env('FRONTEND_MAINTENANCE_MODE'),

    'frontend_page' => env('FRONTEND_FRONTEND_PAGE'),

    'pricing_section' => env('FRONTEND_PRICING_SECTION'),

    'features_section' => env('FRONTEND_FEATURES_SECTION'),

    'reviews_section' => env('FRONTEND_REVIEWS_SECTION'),

    'blogs_section' => env('FRONTEND_BLOGS_SECTION'),

    'faq_section' => env('FRONTEND_FAQ_SECTION'),

    'contact_section' => env('FRONTEND_CONTACT_SECTION'), 

    'custom_url' => [
        'status' => env('FRONTEND_CUSTOM_URL_STATUS'),
        'link' => env('FRONTEND_CUSTOM_URL_LINK'),
    ], 

    'social_twitter' => env('FRONTEND_SOCIAL_TWITTER'),
    'social_facebook' => env('FRONTEND_SOCIAL_FACEBOOK'),
    'social_linkedin' => env('FRONTEND_SOCIAL_LINKEDIN'),
    'social_instagram' => env('FRONTEND_SOCIAL_INSTAGRAM'),

];
