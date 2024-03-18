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

class CommentSheetImport implements ToCollection, WithEvents, SkipsEmptyRows, WithHeadingRow
{
    use Importable, RegistersEventListeners;

    /**
     * @param BeforeSheet $event
     * @return void
     */
    public static function beforeSheet(BeforeSheet $event)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('comments')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            DB::table('comments')->insert([
                'id'              => $row['id'],
                'name'            => $row['name'],
                'email'           => $row['email'],
                'subscribe'       => $row['subscribe'],
                'url'             => $row['url'],
                'comment'         => $row['comment'],
                'avatar'          => $row['avatar'],
                'reply_id'        => $row['reply_id'],
                'main_reply'      => $row['main_reply'],
                'user_id'         => $row['user_id'],
                'post_id'         => $row['post_id'],
                'status'          => $row['status'],
                'created_at'      => Carbon::create($row['created_at'])->format('Y-m-d H:i:s'),
                'updated_at'      => Carbon::create($row['updated_at'])->format('Y-m-d H:i:s')   
            ]);
        }
    }
}
