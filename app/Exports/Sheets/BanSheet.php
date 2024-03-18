<?php

namespace App\Exports\Sheets;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class BanSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return DB::table('bans')->get();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'bannable_type',
            'bannable_id',
            'created_by_type',
            'created_by_id',
            'comment',
            'expired_at',
            'deleted_at',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'bans';
    }
}
