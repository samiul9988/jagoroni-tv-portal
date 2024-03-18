<?php

use Illuminate\Support\Facades\{Auth, Route, Schema};
use Intervention\Image\Facades\Image;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// ------------------------------------ Authentication ------------------------------------
if (Schema::hasTable('settings')) {
    Route::prefix(LaravelLocalization::setLocale())->middleware('XSS', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath')->group(function () {
        config('settings.register') == 'y' ? Auth::routes() : Auth::routes(['register' => false]);
        if (config('settings.email_verification') == 'y') {
            Auth::routes(['verify' => true]);

            Route::get('/email/verify', function () {
                return view('auth.verify');
            })->middleware('auth')->name('verification.notice');
        }
    });
}

Route::post('logout', \App\Http\Controllers\Auth\LogoutController::class);

// ------------------------------------ Dashboard ------------------------------------
Route::get('admin/dashboard', \App\Http\Controllers\Admin\DashboardController::class)
    ->name('admin.dashboard')
    ->middleware('auth', 'auth.locale', 'is-ban', 'verified');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'auth.locale', 'is-ban', 'verified']], function () {

    // ------------------------------------ SETTING ------------------------------------
    Route::controller(\App\Http\Controllers\Admin\SettingController::class)->group(function () {
        Route::patch('settings/change-number-nested-comment', 'changeNumNestedComment');
        Route::patch('settings/change-comment-req-approval', 'changeCommentReqApproval');
        Route::patch('settings/change-send-comment-reply-email', 'changeSendCommentReplyEmail');
        Route::patch('settings/changeStatusMaintenance', 'changeMaintenance');
        Route::patch('settings/changeRegisterMember', 'changeRegisterMember');
        Route::patch('settings/change-active-email-verification', 'changeActiveEmailVerification');
        Route::get('settings/change-dashboard-language', 'changeDashboardLanguage')->name('switch.lang');
        Route::patch('settings/change-default-language', 'changeDefaultLanguage');
        Route::patch('settings/switch-display-language', 'changeDisplayLanguage')->name('switch.display.lang');
        Route::patch('settings/set-config', 'setConfig');
    });

    // ------------------------------------ PERMISSION ------------------------------------
    Route::controller(\App\Http\Controllers\Admin\RoleController::class)->group(function () {
        Route::patch('change-permission', 'changePermission');
        Route::patch('change-all-permission', 'changeAllPermission');
    });

    // ------------------------------------ LANGUAGE ------------------------------------
    Route::controller(\App\Http\Controllers\Admin\LanguageController::class)->group(function () {
        Route::get('getlangcode', 'getLangCode');
        Route::get('change-language-default', 'changeDefault');
        Route::get('show-language', 'dataSelectOption')->name('getdatalanguage');
    });

    // ------------------------------------ LINKS ------------------------------------
    Route::controller(\App\Http\Controllers\Admin\SettingController::class)->group(function () {
        Route::post('createdatalink', 'createDataLink');
        Route::delete('links/{id}/site', 'removeDataLink');
    });

    Route::controller(\App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::post('create-user-links', 'createDataLink');
        Route::delete('links/{id}', 'removeDataLink');
    });

    // ------------------------------------ GALLERY ------------------------------------
    Route::get('gallery/show/{filename}', function ($filename)
    {
        return Image::make(storage_path('app/public/images/' . $filename))->response();
    })->name('gallery.show.image');

    // ------------------------------------ THEME ------------------------------------
    Route::controller(\App\Http\Controllers\Admin\ThemeController::class)->group(function () {
        Route::get('data/themes', 'theme')->name('theme')->middleware('auth');
        Route::get('change-visible-layout-theme', 'changeVisible');
        Route::get('change-custom-layout-theme', 'changeCustom');
        Route::get('change-sidebar-position', 'changeSidebarPosition');
    });

});

// AJAX
Route::group(['prefix' => 'ajax', 'middleware' => ['auth', 'is-ban', 'verified']], function () {
    // ------------------------------------ ROLE ------------------------------------
    Route::get('roles/search', [\App\Http\Controllers\Admin\RoleController::class, 'ajaxSearch'])->name('roles.search');

    Route::controller(\App\Http\Controllers\Admin\SettingController::class)->group(function () {
        Route::get('session-by-device', 'sessionDeviceSetPeriode')->name('device.analytics');
        Route::get('session-visitor-pageview', 'visitorPageViewSetPeriode')->name('visitorpageview.analytics');
    });

    // ---------------------------------- LANGUAGE ----------------------------------
    Route::controller(\App\Http\Controllers\Admin\LanguageController::class)->group(function () {
        Route::get('language/search', 'ajaxSearch')->name('langcode.search');
        Route::get('language/show/search', 'showLanguage')->name('language.search');
    });

    Route::controller(\App\Http\Controllers\Admin\TranslationController::class)->group(function() {
        Route::get('translations/show/group',  'getGroupTranslation')->name('get.group');
        Route::get('translations/show/data', 'getDataTable')->name('getdatatranslations');
    });

    Route::controller(\App\Http\Controllers\Admin\CategoryController::class)->group(function() {
        Route::get('api/v1/categories/search', 'search')->name('api.categories.search');
        Route::get('categories/category-search', 'ajaxCategorySearch')->name('categories.category.search');
    });

    Route::controller(\App\Http\Controllers\Admin\ThemeController::class)->group(function() {
        Route::post('themes/{theme}/pages/{slug}/{layout}', 'widgetStore');
        Route::post('themes/{theme}/pages/{slug}/{layout}/column/create', 'columnStore');
        Route::get('themes/{theme}/pages/{slug}/{layout}/edit', 'widgetEdit');
        Route::patch('themes/{theme}/pages/{slug}/{layout}/widget/{widget}/change-visible-widget', 'changeVisibleWidget');
    });

    Route::post('post/category', [\App\Http\Controllers\Admin\PostController::class, 'categoryStore'])->name('posts.categories.store');

    Route::patch('comments/status/{id}', [\App\Http\Controllers\Admin\CommentController::class, 'updateStatus'])->name('comments.change.status');
});

Route::prefix('admin')->middleware('auth', 'auth.locale', 'is-ban', 'verified')->group(function () {
    // ------------------------------------ PROFILE ------------------------------------
    Route::controller(\App\Http\Controllers\Admin\ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile.index');
        Route::patch('profile/{id}', 'update')->name('profile.update');
        /* ------------------------------------ CHANGE PASSWORD ------------------------------------ */
        Route::get('change-password', 'edit_password')->name('view.password.edit');
        Route::post('change-password', 'update_password')->name('auth.password.update');
        /* ------------------------------------ LINKS ------------------------------------ */
        Route::post('userlink', 'storeLink')->name('store.profile.link');
        Route::delete('userlink/{id}', 'removeLink');
    });
});

Route::prefix('filepond/api')->group(function () {
    Route::get('/filepond-restore/{id}', [\App\Http\Controllers\Admin\FilepondController::class, 'uploadRestore'])->name('filepond.restore');
});

Route::prefix('admin/manage')->middleware('auth', 'auth.locale', 'is-ban', 'verified')->group(function () {

    // ------------------------------------ MASS DELETE ------------------------------------
    Route::get('comments/mass-destroy', [\App\Http\Controllers\Admin\CommentController::class, 'massDestroy'])->name('comments.mass.destroy');
    Route::get('posts/videos/mass-destroy', [\App\Http\Controllers\Admin\VideoPostController::class, 'massDestroy'])->name('videos.mass.destroy');
    Route::get('posts/audios/mass-destroy', [\App\Http\Controllers\Admin\AudioPostController::class, 'massDestroy'])->name('audios.mass.destroy');
    Route::get('categories/mass-destroy', [\App\Http\Controllers\Admin\CategoryController::class, 'massDestroy'])->name('categories.mass.destroy');
    Route::get('contacts/mass-destroy', [\App\Http\Controllers\Admin\ContactController::class, 'massDestroy'])->name('contacts.mass.destroy');
    Route::get('languages/mass-destroy', [\App\Http\Controllers\Admin\LanguageController::class, 'massDestroy'])->name('languages.mass.destroy');
    Route::get('posts/mass-destroy', [\App\Http\Controllers\Admin\PostController::class, 'massDestroy'])->name('posts.mass.destroy');
    Route::get('pages/mass-destroy', [\App\Http\Controllers\Admin\PageController::class, 'massDestroy'])->name('pages.mass.destroy');
    Route::get('roles/mass-destroy', [\App\Http\Controllers\Admin\RoleController::class, 'massDestroy'])->name('roles.mass.destroy');
    Route::get('tags/mass-destroy', [\App\Http\Controllers\Admin\TagController::class, 'massDestroy'])->name('tags.mass.destroy');
    Route::get('users/mass-destroy', [\App\Http\Controllers\Admin\UserController::class, 'massDestroy'])->name('users.mass.destroy');

    // ------------------------------------ ACTION ------------------------------------
    Route::patch('languages/{language}/active', [\App\Http\Controllers\Admin\LanguageController::class, 'setActive']);
    Route::patch('languages/{language}/default', [\App\Http\Controllers\Admin\LanguageController::class, 'setDefault']);
    Route::patch('themes/activated', [\App\Http\Controllers\Admin\ThemeController::class, 'activated'])->name('theme.activated');
    Route::post('/user/darkmode/toggle', [\App\Http\Controllers\Admin\UserDarkModeController::class, 'toggle'])->name('user.darkmode.toggle');

    // ---------------------------------- MENU  ----------------------------------
    Route::controller(\App\Http\Controllers\Admin\MenuController::class)->group(function () {
        Route::get('menus/{menu_id}/lang/{lang}', 'showMenuItem')->name('menus.show.item');
        Route::post('menus-show', 'showMenu')->name('menusshow');
        Route::get('menus/{menu_id}/select-language', 'selectLanguageItemMenu')->name('menus.select.language');
        Route::get('menulist/{menu_id}/lang/{lang}', 'menulist')->name('menulist');
        Route::get('menus/{menu_id}/item/{item_id}/edit', 'editItemMenu')->name('menus.edititem');
        Route::put('menus/updateitemmenu/{id}', 'updateItemMenu')->name('menus.updateitemmenu');
        Route::post('menus/storeitem', 'storeItemMenu')->name('menus.storeitem');
        Route::put('menus/updatemenustructure/{id}', 'updateMenuStructure')->name('menus.change_position_menu');
        Route::delete('menus/{menu_id}/item/{id}', 'deleteitemmenu')->name('deleteitemmenu');
        Route::get('menus/{menu_id}/lang/{lang}', 'showMenuItem')->name('menus.show.item');
    });

    // ---------------------------------- SETTINGS  ----------------------------------
    Route::controller(\App\Http\Controllers\Admin\SettingController::class)->group(function () {
        //view
        Route::get('settings/web-information', 'webInformation')->name('settings.webinfo');
        Route::get('settings/web-contact', 'webContact')->name('settings.webcontact');
        Route::get('settings/web-properties', 'webProperties')->name('settings.webproperties');
        Route::get('settings/web-permalinks', 'webPermalinks')->name('settings.webpermalinks');
        Route::get('settings/web-config', 'webConfig')->name('settings.webconfig');
        Route::get('settings/web-backup', 'webBackup')->name('settings.webbackup');

        //update
        Route::patch('settings/web-information/update', 'updateWebInformation')->name('settings.webinfo.update');
        Route::patch('settings/web-contact/update', 'updateWebContact')->name('settings.webcontact.update');
        Route::patch('settings/web-properties/update', 'updateWebProperties')->name('settings.webproperties.update');
        Route::patch('settings/web-permalinks/update', 'updateWebPermalinks')->name('settings.webpermalinks.update');
        Route::patch('settings/web-config/update', 'updateWebConfig')->name('settings.webconfig.update');
        Route::patch('settings/web-backup/update', 'updateWebBackup')->name('settings.webbackup.update');

        //upload
        Route::post('/settings/web-properties/upload', 'uploadProperties')->name('settings.webproperties.upload');

        Route::get('settings', 'index')->name('settings.index');
        Route::patch('settings/update', 'settingUpdate')->name('settings.update');
        Route::get('settings/export-storage', 'exportStorage')->name('export.storage');
        Route::get('settings/export', 'export')->name('export');
        Route::post('settings/import', 'import')->name('import');
        Route::get('settings/ogi', 'openGraphImage')->name('ogi.index');
        Route::patch('settings/ogi/update', 'ogiCustomUpdate')->name('ogi.update');
    });

    // ---------------------------------- TRANSLATIONS  ----------------------------------
    Route::get('posts/create/{id}/translation', [\App\Http\Controllers\Admin\PostController::class, 'createTranslate'])
        ->name('posts.create.translate');
    Route::get('pages/create/{id}/translation', [\App\Http\Controllers\Admin\PageController::class, 'createTranslate'])
        ->name('pages.create.translate');
    Route::get('posts/videos/create/{id}/translation', [\App\Http\Controllers\Admin\VideoPostController::class, 'createTranslate'])
        ->name('videos.create.translate');
    Route::get('posts/audios/create/{id}/translation', [\App\Http\Controllers\Admin\AudioPostController::class, 'createTranslate'])
        ->name('audios.create.translate');

    Route::get('filemanager', function () {
        return view('admin.filemanager.index');
    });

    Route::controller(\App\Http\Controllers\Admin\TranslationController::class)->group(function () {
        Route::post('translations/{language}/translations', 'store')->name('languages.translations.store');
        Route::get('translations/{language}/translations/create', 'create')->name('languages.translations.create');
        Route::post('translations/{language}', 'update')->name('languages.translations.update');
    });

    Route::controller(\App\Http\Controllers\Admin\ThemeController::class)->group(function () {
        Route::get('change-theme-item-active', 'changeItemActive')->name('theme.item.active');
        Route::get('themes/{theme:name}/layout/edit', 'customizeItem')->name('theme.layout.edit');
        Route::get('themes/{theme}/pages/{slug}/{type}/{section}/edit','sectionEdit')->name('theme.section.edit');
        Route::get('themes/{theme}/pages/{slug}/sidebar/edit', 'SidebarEdit')->name('theme.sidebar.edit');
        Route::get('themes/{theme}/pages/{slug}/footer/edit', 'footerEdit')->name('theme.footer.edit');
        Route::put('themes/{theme}/pages/contact', 'contactConfigUpdate')->name('theme.contact.update');
        Route::put('themes/{theme}/pages/{slug}/{section}', 'sectionUpdate')->name('theme.section.update');
        Route::put('themes/{theme}/pages/{slug}/layout/{layout}', 'widgetUpdate')->name('theme.widget.update');
        Route::put('themes/{theme}/pages/{slug}/layout/{layout}/change-position', 'changePosition')->name('theme.widget-position.update');
        Route::delete('themes/{theme}/pages/{slug}/layout/{layout}/column/{column}', 'destroyColumn')->name('theme.column.delete');
        Route::delete('themes/{theme}/pages/{slug}/layout/{layout}/widget/{widget}', 'destroyWidget')->name('widget.delete');
    });


    // ---------------------------------- THEMES  ----------------------------------
    Route::controller(\App\Http\Controllers\Admin\ThemeController::class)->group(function () {
        Route::get('themes/{theme}/general-layout', 'generalLayout')->name('theme.generallayout');
        Route::get('themes/{theme}/general-layout/{layout}', 'setGeneralLayout')->name('theme.setgenerallayout');
        Route::get('themes/{theme}/pages', 'pages')->name('theme.pages');
        Route::get('themes/{theme}/pages/{slug}', 'layout')->name('theme.layout');
        Route::get('themes/{theme}/pages/{slug}/layout/{layout}', 'widgets')->name('theme.widgets');
        Route::delete('themes/{theme}/pages/{slug}', 'page-destroy')->name('theme.pages.destroy');
        Route::get('themes/{theme}/pages/{slug}/body/edit', 'bodyEdit')->name('theme.body.edit');
    });

    // ---------------------------------- COMMENTS  --------------------------------
    Route::controller(\App\Http\Controllers\Admin\CommentController::class)->group(function () {
        Route::post('comments', 'store')->name('comments.store');
        Route::put('comments/{id}', 'update')->name('comments.update');
        Route::delete('comments/{id}', 'destroy')->name('comments.destroy');
    });

    Route::get('analytics', \App\Http\Controllers\Admin\AnalyticController::class)->name('analytics');

    Route::resource('comments', \App\Http\Controllers\Admin\CommentController::class);
    Route::resource('posts/videos', \App\Http\Controllers\Admin\VideoPostController::class);
    Route::resource('posts/audios', \App\Http\Controllers\Admin\AudioPostController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('translations', \App\Http\Controllers\Admin\TranslationController::class);
    Route::resource('languages', \App\Http\Controllers\Admin\LanguageController::class);
    Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class);
    Route::resource('themes', \App\Http\Controllers\Admin\ThemeController::class);
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class);

});
