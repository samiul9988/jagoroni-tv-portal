<?php

namespace App\Exports\Sheets;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class RoleHasPermissionSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return DB::table('role_has_permissions')->get();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'permission_id',
            'role_id',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'role_has_permissions';
    }
}
