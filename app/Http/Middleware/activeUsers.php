<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

use Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache as FacadesCache;

class activeUsers
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
        if(Auth::check())
        {
            $expireTime=Carbon::now()->addMinutes(1);
            Cache::put('active-user'.Auth::user()->id,true,$expireTime);
        }
        return $next($request);
    }
}
