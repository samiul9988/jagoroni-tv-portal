<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publisher extends Model
{
    protected $fillable = ['name', 'location'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
