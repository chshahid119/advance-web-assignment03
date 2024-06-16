<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class ThrottleRegister
{
    public function handle($request, Closure $next)
    {
        $key = 'register_attempts_' . $request->ip();
        $attempts = Cache::get($key, 0);

        if ($attempts >= 3) {
            return response('Too many attempts. Please try again later.', 429);
        }

        Cache::put($key, $attempts + 1, 60);

        return $next($request);
    }
}
