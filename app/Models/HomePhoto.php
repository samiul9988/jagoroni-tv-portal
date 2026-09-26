<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePhoto extends Model
{
    protected $fillable = ['title', 'image', 'url', 'show_from', 'show_until', 'sort_order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'show_from' => 'date',
        'show_until' => 'date',
    ];

    /** Photos that are switched on and inside their optional date window today. */
    public function scopeVisibleToday($query)
    {
        $today = now()->toDateString();

        return $query->where('is_active', true)
            ->where(fn ($q) => $q->whereNull('show_from')->orWhere('show_from', '<=', $today))
            ->where(fn ($q) => $q->whereNull('show_until')->orWhere('show_until', '>=', $today));
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }
}
