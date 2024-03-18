<?php

use App\Http\Controllers\{CommentController, ImageController, SubscriberController};
use Illuminate\Support\Facades\{Route, Storage};
use Intervention\Image\Facades\Image;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ------------------------------------ Logo & Image ------------------------------------

Route::controller(ImageController::class)->group(function () {
    Route::get('images/{filename}', 'showImage')->name('image.show');
    Route::get('image/{filename}', 'displayImage')->name('image.displayImage');
    Route::get('get/post/image/{filename}', 'displayPostImage')->name('post.image');
    Route::get('get/postimage/{filename}', 'displayPostImageWithoutNoImage')->name('image.post');
    Route::post('image-delete', 'removeUploadImage')->name('removeUploadImage');
    Route::post('image-crop', 'uploadUserPhoto');
});

Route::get('show/logo/{filename}', function ($filename) {
    if (Storage::disk('public')->exists('assets/' . $filename)) {
        return Image::make(public_path('storage/assets/' . $filename))->response();
    } else {
        return Image::make(public_path('themes/magz/images/logo.png'))->response();
    }
})->name('logo.display');

Route::get('show/icon/{filename}', function ($filename) {
    if (Storage::disk('public')->exists('assets/' . $filename)) {
        Image::configure(array('driver' => 'imagick'));
        return Image::make(public_path('storage/assets/' . $filename))->response();
    } else {
        return Image::make(public_path('favicons/favicon-96x96.png'))->response();
    }
})->name('icon.display');

Route::get('auth/logo/{filename}', function ($filename) {
    if (Storage::disk('public')->exists('assets/' . $filename)) {
        return Image::make(public_path('storage/assets/' . $filename))->response();
    } else {
        return Image::make(public_path('img/logo-auth.png'))->response();
    }
})->name('auth.logo');

Route::get('dashboard/logo/{filename}', function ($filename) {
    if (Storage::disk('public')->exists('assets/' . $filename)) {
        return Image::make(public_path('storage/assets/' . $filename))->response();
    } else {
        return Image::make(public_path('img/logo.png'))->response();
    }
})->name('dashboard.logo');

Route::post('subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');

Route::prefix(LaravelLocalization::setLocale())->middleware('public', 'XSS', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'language', 'frontend.locale')->group(function () {
    Route::controller(CommentController::class)->group(function () {
        Route::post('comment', 'store')->name('comment');
        Route::get('show/comment/{id}', 'edit')->name('comment.edit');
        Route::put('update/comment/{id}', 'update')->name('comment.update');
        Route::delete('comment/{id}', 'destroy')->name('comment.destroy');
    });

    Route::controller(SubscriberController::class)->group(function () {
        Route::get('/subscriber/verify/{token}/{email}', 'verify')->name('subscriber_verify');
        Route::get('/unsubscrib/verify/{email}', 'unsubcrib')->name('unsubscrib');
        Route::get('/comment/unsubscrib/verify/{token}', 'unsubscribeCommentReplyVerification')->name('unsubscrib');
    });
});

