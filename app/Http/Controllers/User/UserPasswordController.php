<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\ValidateUserPasswordRule;
use App\Models\User;

class UserPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $google2fa = app('pragmarx.google2fa');

        // Add the secret key to the registration data
        $google_data = $google2fa->generateSecretKey();

        // Save the registration data to the user session for just the next request
        session()->put('google_data', $google_data);

        $qr_code = $google2fa->getQRCodeInline(
            config('app.name'),
            auth()->user()->email,
            $google_data
        );

        return view('user.profile.password');
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new ValidateUserPasswordRule],
            'new_password' => ['required', Rules\Password::min(8)],
            'new_confirm_password' => ['required','same:new_password', Rules\Password::min(8)],
        ]);

        User::where('id', auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        
        toastr()->success(__('Password Successfully Updated'));
        return redirect()->back();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function google(Request $request)
    {

        $google2fa = app('pragmarx.google2fa');

        // Add the secret key to the registration data
        $google_data = $google2fa->generateSecretKey();

        if (!auth()->user()->google2fa_enabled) {
            $user = User::where('id', auth()->user()->id)->first();
            $user->google2fa_secret = $google_data;
            $user->save();
        }

        $qr_code = $google2fa->getQRCodeInline(
            config('app.name'),
            auth()->user()->email,
            $google_data
        );

        return view('user.profile.google', compact('qr_code', 'google_data'));
    }


    /**
     * Activate Google 2FA Security 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate2FA(Request $request)
    {
        $google2fa = app('pragmarx.google2fa');

        $request->validate([
            'key' => 'required|numeric',
        ]);

        $valid = $google2fa->verifyKey(auth()->user()->google2fa_secret, $request->key);

        if ($valid) {      
            $user = User::where('id', auth()->user()->id)->first();      
            $user->google2fa_enabled = true;
            $user->save();
            
            session()->put('2fa', auth()->user()->id);

            toastr()->success(__('Google 2FA Login feature is successfully activated'));
            return redirect()->back();
        } else {
            toastr()->error(__('Provided Google Authentication OTP key do not match'));
            return redirect()->back();
        }
        
    }


    /**
     * Deactivate Google 2FA Security 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate2FA(Request $request)
    {
        $google2fa = app('pragmarx.google2fa');

        $request->validate([
            'key' => 'required|numeric',
        ]);

        $valid = $google2fa->verifyKey(auth()->user()->google2fa_secret, $request->key);

        if ($valid) {
            $user = User::where('id', auth()->user()->id)->first();
            $user->google2fa_secret = '';
            $user->google2fa_enabled = false;
            $user->save();

            if ($request->session()->has('2fa')) {
                session()->forget('2fa');
            }

            toastr()->success(__('Google 2FA Login feature is successfully deactivated'));
            return redirect()->back();
        } else {
            toastr()->error(__('Provided Google Authentication OTP key do not match'));
            return redirect()->back();
        }
        
    }
}


