<?php

namespace App\Imports\Sheets;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeSheet;

class BanSheetImport implements ToCollection, WithEvents, SkipsEmptyRows, WithHeadingRow
{
    use Importable, RegistersEventListeners;

    /**
     * @param BeforeSheet $event
     * @return void
     */
    public static function beforeSheet(BeforeSheet $event)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('bans')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            DB::table('bans')->insert([
                'id'              => $row['id'],
                'bannable_type'   => $row['bannable_type'],
                'bannable_id'     => $row['bannable_id'],
                'created_by_type' => $row['created_by_type'],
                'created_by_id'   => $row['created_by_id'],
                'comment'         => $row['comment'],
                'expired_at'      => Carbon::create($row['expired_at'])->format('Y-m-d H:i:s'),
                'deleted_at'      => Carbon::create($row['deleted_at'])->format('Y-m-d H:i:s'),
                'created_at'      => Carbon::create($row['created_at'])->format('Y-m-d H:i:s'),
                'updated_at'      => Carbon::create($row['updated_at'])->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
