<?php

namespace App\Exports\Sheets;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class MenuItemSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return MenuItem[]|Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return MenuItem::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'label',
            'link',
            'parent',
            'sort',
            'class',
            'menu_id',
            'language',
            'depth',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'menu_items';
    }
}
