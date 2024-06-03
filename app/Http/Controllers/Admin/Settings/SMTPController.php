<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;


class SMTPController extends Controller
{
    /**
     * Display SMTP settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.smtp.index');
    }


    /**
     * Store SMTP settings in env file
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'smtp-host' => 'required',
            'smtp-port' => 'required',
            'smtp-username' => 'required',
            'smtp-password' => 'required',
            'smtp-encryption' => 'required',
        ]);

        $this->storeSettings('MAIL_HOST', request('smtp-host'));
        $this->storeSettings('MAIL_PORT', request('smtp-port'));
        $this->storeSettings('MAIL_USERNAME', request('smtp-username'));
        $this->storeSettings('MAIL_PASSWORD', request('smtp-password'));
        $this->storeSettings('MAIL_FROM_ADDRESS', request('smtp-from'));
        $this->storeSettings('MAIL_ENCRYPTION', request('smtp-encryption'));  

        if (config('mail.from.name') == '') {
            $newName = "'". request('smtp-name') . "'";
            $this->storeSettings('MAIL_FROM_NAME', $newName);
        } else {
            $newName = "'". request('smtp-name') . "'";
            $this->storeWithQuotes('MAIL_FROM_NAME', $newName);
        }

        toastr()->success(__('SMTP settings successfully updated'));
        return redirect()->back();
    }


    /**
     * Send a test email
     */
    public function test(Request $request)
    {
		try {
			
            Mail::to(request('email'))->send(new TestEmail($request));
 
            if (Mail::flushMacros()) {
                return redirect()->back()->with('error', 'Test email failed');
            }
			
		} catch(\Exception $e) {
            toastr()->error(__('Your SMTP settings are not configured correctly yet, make sure to enter correct values'));
            return redirect()->back();
        } 

        toastr()->success(__('Test email successfully sent'));
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
