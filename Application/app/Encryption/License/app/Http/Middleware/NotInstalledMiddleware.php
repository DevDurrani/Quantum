<?php

namespace App\Encryption\License\App\Http\Middleware;

use Closure;

class NotInstalledMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!config('Encryption.install.complete')) {
            return redirect()->route('install.index');
        }
        return $next($request);
    }
}
