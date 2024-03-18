<?php

namespace App\Models;

use App\Helpers\LocalizationHelper;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Term extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'taxonomy',
        'description',
        'parent',
        'language_id',
        'translation',
        'image'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * children
     *
     * @return void
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent');
    }

    /**
     * parent
     *
     * @return void
     */
    public function parentId()
    {
        return $this->belongsTo(self::class, 'parent');
    }

    /**
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    /**
     * @param $query
     */
    public function scopeCategory($query)
    {
        $query->where('taxonomy', 'category');
    }

    /**
     * @param $query
     */
    public function scopeSubcategory($query)
    {
        $query->where('taxonomy', 'category')->where('parent','>',0);
    }

    /**
     * @param $query
     */
    public function scopeTag($query)
    {
        $query->where('taxonomy', 'tag');
    }

    /**
     * @param $query
     * @return void
     */
    public function scopeCurrentLanguage($query)
    {
        $query->where('language_id', LocalizationHelper::getCurrentLocaleId());
    }

    /**
     * @param $query
     * @return void
     */
    public function scopeCurrentLangAuth($query)
    {
        $query->where('language_id', LocalizationHelper::getCurrentLocaleAuthdId());
    }

    /**
     * @param $query
     * @param $name
     */
    public function scopeOfName($query, $name)
    {
        $query->where('name', $name);
    }

    /**
     * @param $query
     * @param $name
     */
    public function scopeSearchName($query, $name)
    {
        $query->where("name", "LIKE", "%$name%");
    }
}
