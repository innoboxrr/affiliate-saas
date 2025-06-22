<?php

namespace Innoboxrr\AffiliateSaas\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        
        $this->mergeConfigFrom(__DIR__ . '/../../config/affiliate.php', 'affiliate');

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