<?php

namespace App\Exports\Sheets;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class SettingSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Setting[]|Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return Setting::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'group',
            'key',
            'value'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'settings';
    }
}
