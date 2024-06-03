<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Cache;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            $lastSeen = Carbon::now()->format('y-m-d H:i:s');

            $onlineUsers = json_decode(Cache::get('isOnline', '{}'), true);

            $onlineUsers[ Auth::user()->id ] = $lastSeen;

            Cache::put('isOnline', json_encode($onlineUsers), 60); // store for 2 minutes
  
            /* user last seen */
           // User::where('id', Auth::user()->id)->update(['last_seen' => now()]);
        }
  
        return $next($request);
    }
}
