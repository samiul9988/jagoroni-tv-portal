<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'designation', 'photo', 'bio', 'is_leader', 'quote', 'education', 'profession',
        'experience', 'location', 'motto', 'facebook', 'twitter', 'linkedin', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_leader' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
}
