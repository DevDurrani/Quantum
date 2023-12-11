<?php

namespace App\Vironeer\License\App\Http\Middleware;

use Closure;

class NotInstalledMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!config('Vironeer.install.complete')) {
            return redirect()->route('install.index');
        }
        return $next($request);
    }
}
