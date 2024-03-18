<?php

namespace App\Exports\Sheets;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ModelHasRoleSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return DB::table('model_has_roles')->get();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'role_id',
            'model_type',
            'model_id',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'model_has_roles';
    }
}
