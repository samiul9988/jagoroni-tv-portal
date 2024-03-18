<?php

namespace App\Exports\Sheets;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ContactSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Contact[]|Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return Contact::all();
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
            'subject',
            'message',
            'status',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'contacts';
    }
}
