<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Helpers\ImageHelper;
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
        Blade::component('front-advertisement', \App\View\Components\Front\Advertisement::class);
        // Model::preventLazyLoading(! app()->isProduction());

        if (Schema::hasTable('settings')) {
            $locale = config('settings.default_language');
            if ($locale) {
                App::setLocale($locale);
            }

            $dashboardLogo = config('settings.logo_dashboard');
            if ($dashboardLogo && ImageHelper::isExists('assets', $dashboardLogo)) {
                config([
                    'adminlte.logo_img' => 'storage/assets/' . $dashboardLogo,
                    'adminlte.logo_img_alt' => config('settings.company_name', 'Jagoroni TV'),
                    'adminlte.logo' => '<b>Jagoroni</b> TV',
                ]);
            }
        }
    }
}
