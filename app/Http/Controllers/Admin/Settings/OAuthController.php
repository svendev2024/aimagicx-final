<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

class OAuthController extends Controller
{
    /**
     * Display OAuth settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.oauth.index');
    }


    /**
     * Store OAuth settings in env file
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'enable-facebook' => 'sometimes|required',
            'facebook-key' => 'required_if:enable-facebook,on',
            'facebook-secret-key' => 'required_if:enable-facebook,on',
            'facebook-redirect' => 'required_if:enable-facebook,on',

            'enable-twitter' => 'sometimes|required',
            'twitter-key' => 'required_if:enable-twitter,on',
            'twitter-secret-key' => 'required_if:enable-twitter,on',
            'twitter-redirect' => 'required_if:enable-twitter,on',

            'enable-google' => 'sometimes|required',
            'google-key' => 'required_if:enable-google,on',
            'google-secret-key' => 'required_if:enable-google,on',
            'google-redirect' => 'required_if:enable-google,on',

            'enable-linkedin' => 'sometimes|required',
            'linkedin-key' => 'required_if:enable-linkedin,on',
            'linkedin-secret-key' => 'required_if:enable-linkedin,on',
            'linkedin-redirect' => 'required_if:enable-linkedin,on',
        ]);

        $this->storeSettings('GENERAL_SETTINGS_OAUTH_LOGIN', request('login-oauth'));

        $this->storeSettings('CONFIG_ENABLE_LOGIN_FACEBOOK', request('enable-facebook'));
        $this->storeSettings('FACEBOOK_API_KEY', request('facebook-key'));  
        $this->storeSettings('FACEBOOK_API_SECRET', request('facebook-secret-key'));  
        $this->storeSettings('FACEBOOK_REDIRECT', request('facebook-redirect')); 
        
        $this->storeSettings('CONFIG_ENABLE_LOGIN_TWITTER', request('enable-twitter'));
        $this->storeSettings('TWITTER_API_KEY', request('twitter-key'));  
        $this->storeSettings('TWITTER_API_SECRET', request('twitter-secret-key'));  
        $this->storeSettings('TWITTER_REDIRECT', request('twitter-redirect')); 

        $this->storeSettings('CONFIG_ENABLE_LOGIN_GOOGLE', request('enable-google'));
        $this->storeSettings('GOOGLE_API_KEY', request('google-key'));  
        $this->storeSettings('GOOGLE_API_SECRET', request('google-secret-key'));  
        $this->storeSettings('GOOGLE_REDIRECT', request('google-redirect')); 

        $this->storeSettings('CONFIG_ENABLE_LOGIN_LINKEDIN', request('enable-linkedin'));
        $this->storeSettings('LINKEDIN_API_KEY', request('linkedin-key'));  
        $this->storeSettings('LINKEDIN_API_SECRET', request('linkedin-secret-key'));  
        $this->storeSettings('LINKEDIN_REDIRECT', request('linkedin-redirect')); 
  
        toastr()->success(__('OAuth settings successfully updated'));
        return redirect()->back();
    }


    /**
     * Record in .env file
     */
    private function storeSettings($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));

        }
    }
}
