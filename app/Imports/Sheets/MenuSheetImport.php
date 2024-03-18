<?php

namespace App\Imports\Sheets;

use App\Models\Menu;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeSheet;

class MenuSheetImport implements ToModel, WithEvents, SkipsEmptyRows, WithHeadingRow
{
    use Importable, RegistersEventListeners;

    /**
     * @param BeforeSheet $event
     * @return void
     */
    public static function beforeSheet(BeforeSheet $event)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('menus')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * @param array $row
     * @return Menu
     */
    public function model(array $row)
    {
        $menu             = new Menu();
        $menu->id         = $row['id'];
        $menu->name       = $row['name'];
        $menu->created_at = Carbon::create($row['created_at'])->format('Y-m-d H:i:s');
        $menu->updated_at = Carbon::create($row['updated_at'])->format('Y-m-d H:i:s');
        $menu->save();
        return $menu;
    }
}
