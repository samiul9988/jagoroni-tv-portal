<?php

namespace App\Providers;

use App\View\Components\Admin\Breadcrumbs;
use App\View\Components\Admin\NavbarLanguageWidget;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AdminlteServiceProvider extends ServiceProvider
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
    public function boot(Dispatcher $events)
    {
        if (Schema::hasTable('settings')) {
            if (config('settings.favicon')) {
                config(['adminlte.use_full_favicon' => false]);
                config(['adminlte.use_custom_favicon' => true]);
                config(['adminlte.path_favicon' => url('icon/' . config('settings.favicon'))
                ]);
            }

            if (config('settings.company_name')) {
                config(['adminlte.logo' => '<b>' . config('settings.company_name') . '</b>']);
            }

            if (config('settings.logo_dashboard')) {
                config(['adminlte.logo_img' => url('dashboard/logo/' . config('settings.logo_dashboard'))]);
            } else {
                config(['adminlte.logo_img' => 'img/logo.png']);
            }

            if (config('settings.logo_auth') && config('adminlte.auth_logo.enabled', true)) {
                config(['adminlte.auth_logo.img.path' => url('auth/logo/' . config('settings.logo_auth'))]);
            } else {
                config(['adminlte.auth_logo.img.path' => 'img/logo-auth.png']);
            }

            if (config('adminlte.preloader.enabled', true)) {
                if (config('settings.logo_dashboard')) {
                    config(['adminlte.preloader.img.path' => url('dashboard/logo/' . config('settings.logo_dashboard'))]);
                } else {
                    config(['adminlte.preloader.img.path' => 'img/logo-auth.png']);
                }
            }
        }

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->addIn('localization', [
                'text'   => 'translations',
                'route'  => ['translations.index', ['language' => config('app.locale')]],
                'can'    => 'read-translations',
                'active' => ['admin/manage/translations/*'],
            ]);
        });

        Blade::component('breadcrumbs', Breadcrumbs::class);
        Blade::component('navbar-language-widget', NavbarLanguageWidget::class);
    }
}
