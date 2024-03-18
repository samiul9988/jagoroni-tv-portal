<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'link',
        'parent',
        'sort',
        'class',
        'menu_id',
        'language',
        'depth'
    ];

    /**
     * @return BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * @return BelongsTo
     */
    public function lang()
    {
        return $this->belongsTo(Language::class, 'language');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getsons($id)
    {
        return $this->where("parent", $id)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getall($id)
    {
        $languageId = $this->getIdByLanguageCode(LaravelLocalization::getCurrentLocale());
        return $this->where("menu", $id)->where('language', $languageId)->orderBy("sort")->get();
    }

    /**
     * @param $menu
     * @return int
     */
    public static function getNextSortRoot($menu)
    {
        return self::where('menu', $menu)->max('sort') + 1;
    }

    /**
     * @return BelongsTo
     */
    public function parent_menu()
    {
        return $this->belongsTo('App\Models\Menu', 'menu');
    }

    /**
     * @return HasMany
     */
    public function child()
    {
        return $this->hasMany(self::class, 'parent')->orderBy('sort', 'ASC');
    }
}
