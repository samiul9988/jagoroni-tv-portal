<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @param $name
     * @return mixed
     */
    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

    /**
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->with('child');
    }

    /**
     * @return BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class,'menu_languages','menu_id','language_id')->withTimestamps();
    }
}
