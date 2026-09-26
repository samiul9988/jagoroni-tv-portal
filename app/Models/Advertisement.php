<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'position',
        'image',
        'url',
        'target',
        'html',
        'width',
        'height',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'width' => 'integer',
        'height' => 'integer',
        'sort_order' => 'integer',
    ];

    public const POSITIONS = [
        'top' => 'Top banner',
        'home_top' => 'Homepage top',
        'home_middle' => 'Homepage middle',
        'sidebar_left' => 'Left sidebar',
        'sidebar_right' => 'Right sidebar',
        'article_top' => 'Article top',
        'article_bottom' => 'Article bottom',
        'footer' => 'Footer',
    ];

    public const TYPES = [
        'image' => 'Image',
        'html' => 'HTML / Script',
    ];
}
