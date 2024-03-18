<?php

namespace App\Exports\Sheets;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return Post[]|Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return Post::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'post_title',
            'post_name',
            'post_summary',
            'post_content',
            'meta_description',
            'meta_keyword',
            'post_status',
            'post_visibility',
            'post_author',
            'post_language',
            'post_type',
            'post_guid',
            'post_hits',
            'like',
            'post_image',
            'post_image_meta',
            'post_mime_type',
            'comment_status',
            'comment_count',
            'post_source',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'posts';
    }
}
