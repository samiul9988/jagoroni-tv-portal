<?php

namespace App\Imports\Sheets;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeSheet;

class UserSheetImport implements ToCollection, WithEvents, SkipsEmptyRows, WithHeadingRow
{
    use Importable, RegistersEventListeners;

    /**
     * @param BeforeSheet $event
     * @return void
     */
    public static function beforeSheet(BeforeSheet $event)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * @param Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            DB::table('users')->insert([
                'id'                => $row['id'],
                'name'              => $row['name'],
                'email'             => $row['email'],
                'email_verified_at' => $row['email_verified_at'],
                'username'          => $row['username'],
                'password'          => Hash::make('admin123'),
                'created_at'        => Carbon::create($row['created_at'])->format('Y-m-d H:i:s'),
                'updated_at'        => Carbon::create($row['updated_at'])->format('Y-m-d H:i:s'),
                'photo'             => $row['photo'],
                'about'             => $row['about'],
                'links'             => $row['links'] == null ? null : $row['links'],
                'occupation'        => $row['occupation'],
                'language'          => $row['language'],
                'darkmode'          => $row['darkmode'],
                'active'            => $row['active'],
                'banned_at'         => $row['banned_at'] == null ? null : Carbon::create($row['banned_at'])->format('Y-m-d H:i:s')
            ]);
        }
    }
}
