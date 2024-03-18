<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'language',
        'country',
        'country_code',
        'direction',
        'active',
        'default'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'language';
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->whereActive('y');
    }

    /**
     * @param $field
     * @return mixed
     */
    public static function getActiveBySelect($field)
    {
        return static::select($field)->whereActive('y')->get();
    }
}
