<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        $request = request();
        $script = str_replace('\\', '/', (string) $request->server->get('SCRIPT_NAME', ''));
        $uri = (string) $request->getRequestUri();

        if (str_contains($script, '/public/index.php') && ! str_contains($uri, '/public/')) {
            $basePath = rtrim(str_replace('/public/index.php', '', $script), '/');
            if ($basePath !== '') {
                URL::forceRootUrl($request->getSchemeAndHttpHost().$basePath);
            }
        }
    }
}
