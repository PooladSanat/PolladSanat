<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class LastUserActivity
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
        if (\Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(1);
            \Cache::put('active' . \Auth::user()->id, true, $expiresAt);
        }
        return $next($request);

    }
}
