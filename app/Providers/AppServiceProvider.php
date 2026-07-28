<?php

namespace App\Providers;

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
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $view->with('globalVisitorCount', \App\Models\Visitor::count());
            $view->with('globalVisitorsToday', \App\Models\Visitor::whereDate('created_at', \Carbon\Carbon::today())->count());
            
            try {
                $globalSettings = \App\Models\Setting::pluck('value', 'key')->toArray();
                $view->with('globalSettings', $globalSettings);
            } catch (\Exception $e) {
                $view->with('globalSettings', []);
            }
        });
    }
}
