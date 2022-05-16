<?php

namespace App\Providers;

use App\Models\Team;
use AWS\CRT\Log;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        HeadingRowFormatter::default('none');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Cashier::useCustomerModel(Team::class);
        Cashier::calculateTaxes();

        RateLimiter::for('instagramImport', function ($job) {
            return Limit::perMinute(1);
        });

        Queue::looping(function ($queue) {
            \Illuminate\Support\Facades\Log::info($queue->queue);
            if ($queue->queue == 'default') {
                return false;
            }
        });
    }
}
