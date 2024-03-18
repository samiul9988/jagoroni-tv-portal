<?php

namespace App\Exports\Sheets;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class MenuSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Menu[]|Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return Menu::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'name',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'menus';
    }
}
