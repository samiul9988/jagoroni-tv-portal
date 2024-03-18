<?php

namespace App\Http\Middleware;

use App\Helpers\Settings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $dashboardLanguage = Settings::key('dashboard_language');

        if (Auth::user()->language) {
            $language = Auth::user()->userLanguage()->first()->language_code;
            Session::put('auth_locale', $language);
            App::setLocale($language);
        } else {
            if (Settings::key('dashboard_language')) {
                App::setLocale($dashboardLanguage);
            } else {
                App::setLocale(config('app.fallback_locale'));
            }
        }
        return $next($request);
    }
}
