<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Language
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
        if ($request->session()->has('applocale'))
        {
            $lang = Session::get('applocale');
            App::setLocale($lang);
        }
        else {
            App::setLocale(config('esttings.theme_language'));
        }
        return $next($request);
    }
}
