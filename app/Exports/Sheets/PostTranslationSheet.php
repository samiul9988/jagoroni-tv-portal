<?php

namespace App\Exports\Sheets;

use App\Models\PostTranslation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PostTranslationSheet implements FromCollection, WithTitle, WithHeadings
{
    public function collection()
    {
        return PostTranslation::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'post_id',
            'translation_id'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'post_translations';
    }
}
