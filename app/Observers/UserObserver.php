<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        if (config('settings.email_verification') == 'disabled') {
            $user->email_verified_at = now();
            $user->save();            
        }        
    }

}
