<?php

namespace App\Exports\Sheets;

use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class LanguageSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Collection|Language[]
     */
    public function collection()
    {
        return Language::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'name',
            'language',
            'country',
            'country_code',
            'direction',
            'active',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'languages';
    }
}
