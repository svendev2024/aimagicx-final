<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Events\RegistrationReferrerBonus;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Exception;

class SocialAuthController extends Controller
{   
    /**
     * Login with social OAuth feature
     * 
     */
    public function redirectToProvider($driver)
    {      
        return Socialite::driver($driver)->redirect();
    }


    public function handleProviderCallback($driver)
    {
        try {
     
            $user = Socialite::driver($driver)->user();

            $existing_user = User::where('oauth_id', $user->getId())->first();
      
            if ($existing_user) {
      
                Auth::login($existing_user);
     
                return redirect()->route('user.dashboard');
      
            } else {

                $new_user = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'oauth_id'=> $user->getId(),
                    'oauth_type'=> $driver,                    
                    'country'=> 'Greenland',                    
                    'password' => Hash::make($user->getEmail()),
                ]);

                event(new Registered($new_user));
        
                $new_user->assignRole(config('settings.default_user'));
                $new_user->status = 'active';
                $new_user->group = config('settings.default_user');
                $new_user->email_verified_at = now();
                $new_user->available_words_prepaid = config('settings.free_tier_words');
                $new_user->available_images_prepaid = config('settings.free_tier_images');
                $new_user->available_chars_prepaid = config('settings.voiceover_welcome_chars');
                $new_user->available_minutes_prepaid = config('settings.whisper_welcome_minutes');
                $new_user->default_voiceover_language = config('settings.voiceover_default_language');
                $new_user->default_voiceover_voice = config('settings.voiceover_default_voice');
                $new_user->job_role = 'Happy Person';
                $new_user->referral_id = strtoupper(Str::random(15));
                $new_user->save();        

                Auth::login($new_user);
      
                toastr()->success(__('Congratulations! Account is activated. Your password is your email'));
                return redirect()->route('user.dashboard');
            }
     
        } catch (Exception $e) {
            toastr()->error(__('Login with your social media account has failed, try again or register with email'));
            return redirect()->route('login');
        }
    }

}
