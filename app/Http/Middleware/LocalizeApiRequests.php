<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Settings;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class LocalizeApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        LaravelLocalization::setLocale($request->header('X-App-Locale') ?: Settings::key('theme_language'));

        return $next($request);
    }
}
