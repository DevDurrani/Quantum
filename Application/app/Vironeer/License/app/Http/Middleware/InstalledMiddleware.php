<?php

namespace Vendor\Vironeer\License\App\Http\Middleware;

use Closure;

class InstalledMiddleware
{
    public function handle($request, Closure $next)
    {
        if (config('Vironeer.install.complete')) {
            return redirect('/');
        }
        return $next($request);
    }
}
