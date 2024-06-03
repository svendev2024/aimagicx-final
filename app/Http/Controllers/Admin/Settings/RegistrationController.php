<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;


class RegistrationController extends Controller
{
    /**
     * Display registration settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.registration.index');
    }


    /**
     * Store registration settings in env file
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'registration' => 'required',
            'email-verification' => 'required',
        ]);

        if (request('country')) {
            $newName = "'". request('country') . "'";
            $this->storeWithQuotes('GENERAL_SETTINGS_DEFAULT_COUNTRY', $newName);
        }

        $this->storeSettings('GENERAL_SETTINGS_REGISTRATION', request('registration'));
        $this->storeSettings('GENERAL_SETTINGS_EMAIL_VERIFICATION', request('email-verification'));
  
        toastr()->success(__('Registration settings successfully updated'));
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
