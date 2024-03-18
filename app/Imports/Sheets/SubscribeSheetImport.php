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

class SubscribeSheetImport implements ToCollection, WithEvents, SkipsEmptyRows, WithHeadingRow
{
    use Importable, RegistersEventListeners;

    /**
     * @param BeforeSheet $event
     * @return void
     */
    public static function beforeSheet(BeforeSheet $event)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('subscribers')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            DB::table('subscribers')->insert([
                'id'              => $row['id'],
                'email'           => $row['email'],
                'token'           => $row['token'],
                'status'          => $row['status'],
                'created_at'      => Carbon::create($row['created_at'])->format('Y-m-d H:i:s'),
                'updated_at'      => Carbon::create($row['updated_at'])->format('Y-m-d H:i:s')
            ]);
        }
    }
}
