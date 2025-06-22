<?php

namespace Innoboxrr\AffiliateSaas\Providers;

use Illuminate\Support\ServiceProvider;
use Innoboxrr\AffiliateSaas\Console\Commands\BuildAffiliateScript;


class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/affiliate.php', 'affiliate');
        $this->commands([
            BuildAffiliateScript::class,
        ]);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'affiliate');
        if ($this->app->runningInConsole()) {
            // $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/affiliate'),], 'views');
            $this->publishes([__DIR__.'/../../config/affiliate.php' => config_path('affiliate.php')], 'config');
        }
    }
}