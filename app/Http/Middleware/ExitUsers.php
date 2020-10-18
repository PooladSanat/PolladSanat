<?php

namespace App\Http\Middleware;

use Closure;

class ExitUsers
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
        if (\Auth::check() && \Auth::user()->exit != null) {
            \Auth::logout();
            session()->flash('exit', 'پرسنل عزیز نرم افزار در حال به روزرسانی میباشد لطفا صبر کنید');
            return redirect()->route('login');
        }
        return $response;
    }
}
