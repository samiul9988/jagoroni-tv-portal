<?php

namespace App\Exports\Sheets;

use App\Models\Term;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class TermSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Term[]|Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return Term::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'name',
            'slug',
            'taxonomy',
            'description',
            'image',
            'parent',
            'language_id',
            'translation',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'terms';
    }
}
