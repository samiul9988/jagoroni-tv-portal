<?php

use App\Http\Controllers\Contact\ContactController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->middleware('public','XSS','localeSessionRedirect','localizationRedirect','localeViewPath')->group(function () {
    Route::post('/sendcontact', [ContactController::class, 'store'])->name('sendcontact');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
});