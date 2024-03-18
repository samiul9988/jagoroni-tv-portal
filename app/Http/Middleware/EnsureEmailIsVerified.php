<?php

namespace App\Http\Middleware;

use App\Helpers\Settings;
use Closure;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified as Middleware;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureEmailIsVerified extends Middleware
{
    /**
     * @param $request
     * @param Closure $next
     * @param $redirectToRoute
     * @return RedirectResponse|Response|mixed|never|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (config('settings.email_verification') == 'y') {
            if (!$request->user() ||
                ($request->user() instanceof MustVerifyEmail &&
                    !$request->user()->hasVerifiedEmail())) {
                return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
            }
        }

        return $next($request);
    }
}
