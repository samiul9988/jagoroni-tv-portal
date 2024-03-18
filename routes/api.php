<?php

use App\Http\Controllers\Api\Admin\ChartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('chart/device', [ChartController::class, 'showDevice'])->name('device_chart');
Route::get('chart/google-analytics', [ChartController::class, 'showTotalVisitorsAndPageViews'])->name('visitor_pageview_chart');