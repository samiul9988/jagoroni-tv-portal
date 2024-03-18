<?php

namespace App\Exports\Sheets;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return User[]|Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'email_verified_at',
            'username',
            'created_at',
            'updated_at',
            'photo',
            'about',
            'links',
            'occupation',
            'language',
            'darkmode',
            'active',
            'banned_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'users';
    }
}
