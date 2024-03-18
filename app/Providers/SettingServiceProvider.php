<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Factory $cache, Setting $settings)
    {
        if (Schema::hasTable('settings')) {
            $settings = $cache->remember('settings', 60, function () use ($settings) {
                return $settings->pluck('value', 'key')->all();
            });
            config()->set('settings', $settings);
        }
    }
}
