<?php

namespace App\Exports;

use App\Exports\Sheets\BanSheet;
use App\Exports\Sheets\ContactSheet;
use App\Exports\Sheets\LanguageSheet;
use App\Exports\Sheets\MenuItemSheet;
use App\Exports\Sheets\MenuLanguageSheet;
use App\Exports\Sheets\MenuSheet;
use App\Exports\Sheets\ModelHasRoleSheet;
use App\Exports\Sheets\PermissionSheet;
use App\Exports\Sheets\PostSheet;
use App\Exports\Sheets\PostTermSheet;
use App\Exports\Sheets\PostTranslationSheet;
use App\Exports\Sheets\RoleHasPermissionSheet;
use App\Exports\Sheets\RolesSheet;
use App\Exports\Sheets\SettingSheet;
use App\Exports\Sheets\TermSheet;
use App\Exports\Sheets\ThemeSheet;
use App\Exports\Sheets\TranslationSheet;
use App\Exports\Sheets\UserSheet;
use App\Exports\Sheets\CommentSheet;
use App\Exports\Sheets\SubscribeSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MagzExport implements WithMultipleSheets
{
    use Exportable;

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new SettingSheet();
        $sheets[] = new LanguageSheet();
        $sheets[] = new RolesSheet();
        $sheets[] = new PermissionSheet();
        $sheets[] = new RoleHasPermissionSheet();
        $sheets[] = new ModelHasRoleSheet();
        $sheets[] = new UserSheet();
        $sheets[] = new BanSheet();
        $sheets[] = new ContactSheet();
        $sheets[] = new TermSheet();
        $sheets[] = new PostSheet();
        $sheets[] = new PostTermSheet();
        $sheets[] = new ThemeSheet();
        $sheets[] = new TranslationSheet();
        $sheets[] = new PostTranslationSheet();
        $sheets[] = new MenuSheet();
        $sheets[] = new MenuItemSheet();
        $sheets[] = new MenuLanguageSheet();
        $sheets[] = new CommentSheet();
        $sheets[] = new SubscribeSheet();

        return $sheets;
    }
}
