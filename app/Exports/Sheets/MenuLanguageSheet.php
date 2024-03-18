<?php

namespace App\Exports\Sheets;

use App\Models\MenuLanguage;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class MenuLanguageSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return MenuLanguage[]|Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return MenuLanguage::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'menu_id',
            'language_id',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'menu_languages';
    }
}
