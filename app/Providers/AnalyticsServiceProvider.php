<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AnalyticsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('AnalyticsSingleton', function () {
            return new \App\Singletons\AnalyticsSingleton();
        });
    }

    public function boot(): void
    {
    }
}
