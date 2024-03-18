<?php

namespace App\Http\Middleware;

use app\Helpers\SeoHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('settings.maintenance') == 'y') {
            SeoHelper::getAll(__('web.maintenance_mode'));
            abort('503');
        }

        return $next($request);
    }
}
