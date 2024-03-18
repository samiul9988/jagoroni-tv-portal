<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dashboardLanguage = config('settings.dashboard_language');

        if (Auth::user()->darkmode) {
            config(['adminlte.classes_topnav' => 'navbar-black navbar-dark']);
        }

        if (Auth::user()->language) {
            $locale = Auth::user()->userLanguage->language;
            App::setLocale($locale);
        } else {
            if ($dashboardLanguage) {
                App::setLocale($dashboardLanguage);
            } else {
                App::setLocale(config('app.fallback_locale'));
            }
        }
        return $next($request);
    }
}
