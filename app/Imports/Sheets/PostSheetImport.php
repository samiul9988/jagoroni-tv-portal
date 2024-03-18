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

class PostSheetImport implements ToCollection, WithEvents, SkipsEmptyRows, WithHeadingRow
{
    use Importable, RegistersEventListeners;

    /**
     * @param BeforeSheet $event
     * @return void
     */
    public static function beforeSheet(BeforeSheet $event)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('posts')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            DB::table('posts')->insert([
                'id'               => $row['id'],
                'post_title'       => $row['post_title'],
                'post_name'        => $row['post_name'],
                'post_summary'     => $row['post_summary'],
                'post_content'     => $row['post_content'],
                'meta_description' => $row['meta_description'],
                'meta_keyword'     => $row['meta_keyword'],
                'post_status'      => $row['post_status'],
                'post_visibility'  => $row['post_visibility'],
                'post_author'      => $row['post_author'],
                'post_language'    => $row['post_language'],
                'post_type'        => $row['post_type'],
                'post_guid'        => $row['post_guid'],
                'post_hits'        => $row['post_hits'] == null ? '0' : $row['post_hits'],
                'like'             => $row['like'] == null ? '0' : $row['like'],
                'post_image'       => $row['post_image'],
                'post_image_meta'  => $row['post_image_meta'],
                'post_mime_type'   => $row['post_mime_type'] == null ? '' : $row['post_mime_type'],
                'comment_status'   => $row['comment_status'] == null ? 'open' : $row['comment_status'],
                'comment_count'    => $row['comment_count'] == null ? '0' : $row['comment_count'],
                'post_source'      => $row['post_source'] == null ? '' : $row['post_source'],
                'created_at'       => Carbon::create($row['created_at'])->format('Y-m-d H:i:s'),
                'updated_at'       => Carbon::create($row['updated_at'])->format('Y-m-d H:i:s')
            ]);
        }
    }
}
