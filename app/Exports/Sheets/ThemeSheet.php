<?php

namespace App\Exports\Sheets;

use App\Models\Theme;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class ThemeSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Term[]|Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return Theme::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'theme',
            'page',
            'title',
            'slug',
            'template',
            'setting',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'themes';
    }
}
