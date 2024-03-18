<?php

namespace App\Exports\Sheets;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class PermissionSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Collection|\Illuminate\Support\Collection|Permission[]
     */
    public function collection()
    {
        return Permission::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'name',
            'guard_name',
            'created_at',
            'updated_at',
            'alias'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'permissions';
    }
}
