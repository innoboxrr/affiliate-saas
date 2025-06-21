<?php

namespace Innoboxrr\AffiliateSaas\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        
        // $this->mergeConfigFrom(__DIR__ . '/../../config/innoboxrraffiliatesaas.php', 'innoboxrraffiliatesaas');

    }

    public function boot()
    {
        
        // $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // $this->loadViewsFrom(__DIR__.'/../../resources/views', 'innoboxrraffiliatesaas');

        if ($this->app->runningInConsole()) {
            
            // $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/innoboxrraffiliatesaas'),], 'views');

            // $this->publishes([__DIR__.'/../../config/innoboxrraffiliatesaas.php' => config_path('innoboxrraffiliatesaas.php')], 'config');

        }

    }
    
}