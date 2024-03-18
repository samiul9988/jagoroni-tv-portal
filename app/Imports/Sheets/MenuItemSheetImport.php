<?php

namespace App\Imports\Sheets;

use App\Models\MenuItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeSheet;

class MenuItemSheetImport implements ToModel, WithEvents, SkipsEmptyRows, WithHeadingRow, SkipsUnknownSheets
{
    use Importable, RegistersEventListeners;

    /**
     * @param BeforeSheet $event
     * @return void
     */
    public static function beforeSheet(BeforeSheet $event)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('menu_items')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * @param array $row
     * @return MenuItem
     */
    public function model(array $row)
    {
        $item             = new MenuItem();
        $item->id         = $row['id'];
        $item->label      = $row['label'];
        $item->link       = $row['link'];
        $item->parent     = $row['parent'] == null ? '0' : $row['parent'];
        $item->sort       = $row['sort'] == null ? '0' : $row['sort'];
        $item->class      = $row['class'];
        $item->menu_id    = $row['menu_id'];
        $item->language   = $row['language'];
        $item->depth      = $row['depth'] == null ? '0' : $row['depth'];
        $item->created_at = Carbon::create($row['created_at'])->format('Y-m-d H:i:s');
        $item->updated_at = Carbon::create($row['updated_at'])->format('Y-m-d H:i:s');
        $item->save();
        return $item;
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
