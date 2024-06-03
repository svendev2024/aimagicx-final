<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    protected function user()
    {
        $user = null;
        if (Auth::user()) {
            $user = User::where('id', Auth::user()->id)->first();
        }

        return $user;
    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $information_rows = ['title', 'author', 'keywords', 'description', 'css', 'js'];
        $information = [];
        $settings = Setting::all();

        foreach ($settings as $row) {
            if (in_array($row['name'], $information_rows)) {
                $information[$row['name']] = $row['value'];
            }
        }

        return view('auth.login', compact('information'));
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {   
        if (config('services.google.recaptcha.enable') == 'on') {

            $recaptchaResult = $this->reCaptchaCheck(request('recaptcha'));

            if ($recaptchaResult->success != true) {
                return redirect()->back()->with('error', 'Google reCaptcha Validation has Failed');
            }

            if ($recaptchaResult->score >= 0.5) {

                $request->authenticate();
                
                if (Auth::check() && auth()->user()->google2fa_enabled && !$request->session()->has('2fa')) {
            
                    return redirect()->route('login.2fa');
    
                } else {

                    if (auth()->user()->hasRole('admin')) {
                        
                        $request->session()->regenerate();

                        return redirect()->route('admin.dashboard');            
                    }
                    
                    if (config('frontend.maintenance') == 'on') {

                        if (auth()->user()->group != 'admin') {
                            return redirect('/')->with(Auth::logout());            
                        }

                    } else{

                        $request->session()->regenerate();

                        return redirect()->intended(RouteServiceProvider::HOME);
                    }
                }
                  

            } else {
                return redirect()->back()->with('error', 'Google reCaptcha Validation has Failed');
            }

        } else {
            
            $request->authenticate();

            if (Auth::check() && auth()->user()->google2fa_enabled && !$request->session()->has('2fa')) {
            
                return redirect()->route('login.2fa');

            } else {

                if (auth()->user()->hasRole('admin')) {

                    $request->session()->regenerate();
    
                    return redirect()->route('admin.dashboard');            
                }
            
                if (config('frontend.maintenance') == 'on') {

                    if (auth()->user()->group != 'admin') {
                        return redirect('/')->with(Auth::logout());          
                    }
    
                } else{
    
                    $request->session()->regenerate();
    
                    return redirect()->intended(RouteServiceProvider::HOME);
                }
            }
        }
              
    }


    /**
     * Handle an incoming 2FA authentication request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function twoFactorAuthentication(Request $request)
    {
        return view('auth.2fa');
    }


    /**
     * Handle an incoming 2FA authentication request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function twoFactorAuthenticationStore(Request $request)
    {

        $request->validate([
            'code' => 'required|numeric',
        ]);

        $google2fa = app('pragmarx.google2fa');
 

        $valid = $google2fa->verifyKey($this->user()->google2fa_secret, $request->code);

        if ($valid) {

            session()->put('2fa', $this->user()->id);

            if ($this->user()->hasRole('admin')) {

                $request->session()->regenerate();
    
                return redirect()->route('admin.dashboard');            
            }
        
            if (config('frontend.maintenance') == 'on') {
                if ($this->user()->group != 'admin') {
                    return redirect('/')->with(Auth::logout());          
                }
    
            } else{

                $request->session()->regenerate();
    
                return redirect()->intended(RouteServiceProvider::HOME);
            }
            
        } else {
            return redirect()->route('login.2fa')->with('error','Incorrect OTP key was provided. Try again.');
        }
        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    private function reCaptchaCheck($recaptcha)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $data = [
                'secret' => config('services.google.recaptcha.secret_key'),
                'response' => $recaptcha,
                'remoteip' => $remoteip
        ];

        $options = [
                'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
                ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        return $resultJson;
    }

}
