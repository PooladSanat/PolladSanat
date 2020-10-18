<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        //If the status is not approved redirect to login
        if (Auth::check() && Auth::user()->status != null) {
            Auth::logout();
            session()->flash('checkUser','عزیز دسترسی های شما غیر فعال شده است.');
            return redirect()->route('login');
        }
        return $response;
    }
}
