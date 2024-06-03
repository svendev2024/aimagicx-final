<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

class GlobalController extends Controller
{
    /**
     * Display global settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.global.index');
    }


    /**
     * Store global settings 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {        
        request()->validate([
            'enable-recaptcha' => 'sometimes|required',
            'recaptcha-site-key' => 'required_if:enable-recaptcha,on',
            'recaptcha-secret-key' => 'required_if:enable-recaptcha,on',

            'enable-maps' => 'sometimes|required',
            'google-key' => 'required_if:enable-maps,on',

            'enable-analytics' => 'sometimes|required',
            'google-analytics' => 'required_if:enable-analytics,on',

            'site-name' => 'required|string',
            'site-website' => 'required',
        ]);  

        $this->storeSettings('GOOGLE_RECAPTCHA_ENABLE', request('enable-recaptcha'));
        $this->storeSettings('GOOGLE_RECAPTCHA_SITE_KEY', request('recaptcha-site-key'));
        $this->storeSettings('GOOGLE_RECAPTCHA_SECRET_KEY', request('recaptcha-secret-key'));

        $this->storeSettings('GOOGLE_MAPS_ENABLE', request('enable-maps'));
        $this->storeSettings('GOOGLE_MAPS_KEY', request('google-key'));

        $this->storeSettings('GOOGLE_ANALYTICS_ENABLE', request('enable-analytics'));
        $this->storeSettings('GOOGLE_ANALYTICS_ID', request('google-analytics'));

        if (request('site-name')) {
            $newName = "'". request('site-name') . "'";
            $this->storeWithQuotes('APP_NAME', $newName);
        }
        
        $this->storeSettings('APP_URL', request('site-website'));
        $this->storeSettings('APP_EMAIL', request('site-email'));

        $this->storeSettings('APP_TIMEZONE', request('time-zone'));

        $this->storeSettings('GENERAL_SETTINGS_DEFAULT_USER_GROUP', request('user-group'));
        $this->storeSettings('GENERAL_SETTINGS_SUPPORT_EMAIL', request('support-ticket'));
        $this->storeSettings('GENERAL_SETTINGS_USER_SUPPORT', request('user-support'));
        $this->storeSettings('GENERAL_SETTINGS_USER_NOTIFICATION', request('user-notification'));
        $this->storeSettings('GENERAL_SETTINGS_LIVE_CHAT', request('enable-live-chat'));
        $this->storeSettings('GENERAL_SETTINGS_LIVE_CHAT_LINK', request('live-chat-link'));

       
        # Enable/Disable GDRP Cookie
        if (request('enable-gdpr') == 'on') {
            $this->storeSettings('COOKIE_CONSENT_ENABLED', true);
        } else {
            $this->storeSettings('COOKIE_CONSENT_ENABLED', false);
        }

        toastr()->success(__('Global settings were successfully updated'));
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

    private function storeWithQuotes($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . '\'' . env($key) . '\'', $key . '=' . $value, file_get_contents($path)
            ));

        }
    }
}
