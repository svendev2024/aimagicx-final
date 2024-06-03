<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LicenseController;
use Illuminate\Http\Request;
use App\Models\Setting;


class ActivationController extends Controller
{   
    protected $api;

    public function __construct()
    {
        $this->api = new LicenseController();
    }

    /**
     * Dispaly activation index page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verify = $this->api->verify_license();

        $notification = $verify['status'];

        $information_rows = ['license', 'username'];
        $information = [];
        $settings = Setting::all();

        foreach ($settings as $row) {
            if (in_array($row['name'], $information_rows)) {
                $information[$row['name']] = $row['value'];
            }
        }

        return view('admin.settings.activation.index', compact('notification', 'information'));
    }


    /**
     * Store activation key
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'license' => 'required',
            'username' => 'required',
        ]);

        $status = $this->api->activate_license(request('license'), request('username'));

        if ($status['status'] == true) {

            $rows = ['license', 'username'];        
            foreach ($rows as $row) {
                Setting::where('name', $row)->update(['value' => $request->input($row)]);
            }

            toastr()->success(__('Application license was successfully activated'));
            return redirect()->back();
        } else {
            toastr()->error(__('There was an error while activating your application, please contact support team'));
            return redirect()->back();
        }
        
    }


    /**
     * Show delete activation key confirmation
     *
     */
    public function remove()
    {
        return view('admin.settings.activation.delete');  
    }


    /**
     * Remove activation key and deactivate it
     *
     */
    public function destroy()
    {
        $verify = $this->api->deactivate_license();

        if ($verify['status']) {
            $this->storeSettings('GENERAL_SETTINGS_ENVATO_ACTIVATION', ''); 
            $this->storeSettings('GENERAL_SETTINGS_ENVATO_USERNAME', ''); 

            $notification = false;
            toastr()->success(__('Application license was successfully deactivated'));
            return redirect()->back();
        }
    }


    /**
     * Hidden manual activation that is accessible only for admin group
     *
     */
    public function showManualActivation()
    {
        $information_rows = ['css', 'js'];
        $information = [];
        $settings = Setting::all();

        foreach ($settings as $row) {
            if (in_array($row['name'], $information_rows)) {
                $information[$row['name']] = $row['value'];
            }
        }

        return view('admin.settings.activation.manual', compact('information'));
    }


    /**
     * Store and activate via manual activation feature
     *
     */
    public function storeManualActivation(Request $request)
    {
        request()->validate([
            'license' => 'required',
            'username' => 'required',
        ]);

        $status = $this->api->activate_license(request('license'), request('username'));

        if ($status['status'] == true) {

            $rows = ['license', 'username'];        
            foreach ($rows as $row) {
                Setting::where('name', $row)->update(['value' => $request->input($row)]);
            }

            toastr()->success(__('Application license was successfully activated'));
            return redirect()->back();
        } else {
            toastr()->error(__('There was an error while activating your application, please contact support team'));
            return redirect()->back();
        }
    }


    /**
     * Record activation in .env
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
