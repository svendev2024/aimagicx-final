<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Install
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the app has been not been installed
        if (!file_exists(storage_path('installed'))) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
