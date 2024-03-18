<?php

namespace App\Imports;

use App\Imports\Sheets\BanSheetImport;
use App\Imports\Sheets\CommentSheetImport;
use App\Imports\Sheets\ContactSheetImport;
use App\Imports\Sheets\LanguageSheetImport;
use App\Imports\Sheets\MenuItemSheetImport;
use App\Imports\Sheets\MenuLanguageSheetImport;
use App\Imports\Sheets\MenuSheetImport;
use App\Imports\Sheets\ModelHasRoleSheetImport;
use App\Imports\Sheets\PermissionSheetImport;
use App\Imports\Sheets\PostSheetImport;
use App\Imports\Sheets\PostTermSheetImport;
use App\Imports\Sheets\PostTranslationSheetImport;
use App\Imports\Sheets\RoleHasPermissionSheetImport;
use App\Imports\Sheets\RoleSheetImport;
use App\Imports\Sheets\SettingSheetImport;
use App\Imports\Sheets\SubscribeSheetImport;
use App\Imports\Sheets\TermSheetImport;
use App\Imports\Sheets\TranslationSheetImport;
use App\Imports\Sheets\UserSheetImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MagzImport implements WithMultipleSheets
{    
    /**
     * sheets
     *
     * @return array
     */
    public function sheets(): array
    {
        return [
            'settings'             => new SettingSheetImport(),
            'languages'            => new LanguageSheetImport(),
            'roles'                => new RoleSheetImport(),
            'permissions'          => new PermissionSheetImport(),
            'role_has_permissions' => new RoleHasPermissionSheetImport(),
            'model_has_roles'      => new ModelHasRoleSheetImport(),
            'users'                => new UserSheetImport(),
            'bans'                 => new BanSheetImport(),
            'contacts'             => new ContactSheetImport(),
            'terms'                => new TermSheetImport(),
            'translations'         => new TranslationSheetImport(),
            'posts'                => new PostSheetImport(),
            'post_term'            => new PostTermSheetImport(),
            'post_translations'    => new PostTranslationSheetImport(),
            'menus'                => new MenuSheetImport(),
            'menu_items'           => new MenuItemSheetImport(),
            'menu_languages'       => new MenuLanguageSheetImport(),
            'comments'             => new CommentSheetImport(),
            'subscribers'           => new SubscribeSheetImport()
        ];
    }
}
