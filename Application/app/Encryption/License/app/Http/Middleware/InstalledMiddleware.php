<?php

namespace App\Encryption\License\App\Http\Middleware;

use Closure;

class InstalledMiddleware
{
    public function handle($request, Closure $next)
    {
        if (config('vironeer.install.complete')) {
            return redirect('/');
        }
        return $next($request);
    }
}
