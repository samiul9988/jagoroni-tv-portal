<?php

namespace App\Exports\Sheets;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class CommentSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return DB::table('comments')->get();
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
            'subscribe',
            'url',
            'comment',
            'avatar',
            'reply_id',
            'main_id',
            'user_id',
            'post_id',
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
        return 'comments';
    }
}
