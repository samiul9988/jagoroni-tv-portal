<?php

namespace App\Exports\Sheets;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class TranslationSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Translation[]|Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return Translation::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'value'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'translations';
    }
}
