<?php

namespace App\Vironeer\License;

use App\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Vironeer\License\App\Http\Middleware\DemoTypeMiddleware;
use App\Vironeer\License\App\Http\Middleware\InstalledMiddleware;
use App\Vironeer\License\App\Http\Middleware\NoSaasMiddleware;
use App\Vironeer\License\App\Http\Middleware\NotInstalledMiddleware;
use App\Vironeer\License\App\Http\Middleware\SaasMiddleware;

class VironeerLicenseServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Vironeer\License\App\Http\Controllers';

    public function boot()
    {
        $this->registerHelpers();
        $router = $this->app->make(Router::class);

        $router->aliasMiddleware('installed', InstalledMiddleware::class);
        $router->aliasMiddleware('notInstalled', NotInstalledMiddleware::class);
        $router->aliasMiddleware('saas', SaasMiddleware::class);
        $router->aliasMiddleware('noSaas', NoSaasMiddleware::class);

        if (demoMode()) {
            $kernel = $this->app->make(Kernel::class);
            $kernel->appendMiddlewareToGroup('web', DemoTypeMiddleware::class);
        }

        Route::group(['namespace' => $this->namespace], function () {
            $this->loadRoutesFrom(__DIR__ . '/Routes.php');
        });

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'Vironeer');

    }
    public function registerHelpers()
    {
        if (file_exists($file = __DIR__ . '/Helper.php')) {
            require $file;
        }
    }
}
