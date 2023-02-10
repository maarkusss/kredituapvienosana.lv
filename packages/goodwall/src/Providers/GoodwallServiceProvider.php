<?php

namespace Goodday\Goodwall\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class GoodwallServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__, 2) . '/config/goodwall.php', 'goodwall');

        Route::middleware('api')
            ->group(dirname(__DIR__, 2) . '/routes/api.php');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(dirname(__DIR__, 2) . '/database/migrations');

        if (config('goodwall.enabled') === false) {
            return;
        }

        if ($this->app->runningInConsole()) {
            $this->publishables();
        }
    }

    public function publishables()
    {
        $this->publishes([
            dirname(__DIR__, 2) . '/config/goodwall.php' => config_path('goodwall.php'),
        ], 'config');
    }
}
