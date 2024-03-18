<?php

namespace App\Exports\Sheets;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PostTermSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return DB::table('post_term')->get();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'post_id',
            'term_id',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'post_term';
    }
}