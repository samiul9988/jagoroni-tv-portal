<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveProgram extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'start_time', 'end_time', 'image', 'video_url', 'is_featured', 'sort_order', 'is_active'];

    protected $casts = ['is_featured' => 'boolean', 'is_active' => 'boolean', 'sort_order' => 'integer'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getStartLabelAttribute(): string
    {
        return substr((string) $this->start_time, 0, 5);
    }

    public function getEndLabelAttribute(): ?string
    {
        return $this->end_time ? substr((string) $this->end_time, 0, 5) : null;
    }

    /** True while the current time (HH:MM:SS) falls in the program's slot. */
    public function isOnAir(string $now): bool
    {
        $start = (string) $this->start_time;
        $end = $this->end_time ? (string) $this->end_time : null;

        if ($end === null) {
            return $now >= $start;
        }

        // Slots that pass midnight (e.g. 23:00 - 01:00).
        return $end >= $start ? ($now >= $start && $now < $end) : ($now >= $start || $now < $end);
    }
}
