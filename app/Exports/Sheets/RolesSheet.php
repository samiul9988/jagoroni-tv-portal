<?php

namespace App\Exports\Sheets;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\FromCollection;

class RolesSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Collection|\Illuminate\Support\Collection|Role[]
     */
    public function collection()
    {
        return Role::all();
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
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'roles';
    }
}
