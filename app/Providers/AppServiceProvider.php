<?php

namespace App\Providers;

use App\Models\GeneralSettings;
use Illuminate\Support\ServiceProvider;
use View;

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
        $general_settings = GeneralSettings::first();
        $report_users = json_decode($general_settings->weekly_report_module_users, true)['users'] ?? [];

        View::share(['general_settings' => $general_settings, 'report_users' => $report_users]);
    }



}
