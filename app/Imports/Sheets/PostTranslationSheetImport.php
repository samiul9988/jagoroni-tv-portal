<?php

namespace App\Imports\Sheets;

use App\Models\PostTranslation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeSheet;

class PostTranslationSheetImport implements ToModel, WithEvents, SkipsEmptyRows, WithHeadingRow
{
    use Importable, RegistersEventListeners;

    /**
     * @param BeforeSheet $event
     * @return void
     */
    public static function beforeSheet(BeforeSheet $event)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('post_translations')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * @param array $row
     * @return PostTranslation
     */
    public function model(array $row)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        return new PostTranslation([
            'post_id'        => $row['post_id'],
            'translation_id' => $row['translation_id']
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
