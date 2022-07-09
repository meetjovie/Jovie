<?php

namespace App\Providers;

use App\Models\Team;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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
            if ($queue->queue == 'twitch' && Cache::has('twitch_lock')) {
                return false;
            } elseif ($queue->queue == 'instagram' && (Cache::has('instagram_lock') || Cache::has('instagram_paused'))) {
                return false;
            }
        });
    }
}
