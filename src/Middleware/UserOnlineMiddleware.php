<?php

namespace Komicho\Laravel\Middleware;

use Closure;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class UserOnlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check()) {
            Cache::put('userIsOnline-'.Auth::user()->id, 'true', now()->addMinutes(config('komichoUserOnline.time_allowed')));
        }
        return $response;
    }
}
