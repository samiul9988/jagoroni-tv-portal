<?php

namespace App\Services;

use App\Models\{Language, Menu, MenuItem};
use App\Traits\LanguageTrait;
use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

Class MenuService
{
    use LanguageTrait;

    protected $menu, $menuItem, $language, $slugify;

    /**
     * @param MenuItem $menuItem
     */
    public function __construct(Menu $menu, MenuItem $menuItem, Language $language, Slugify $slugify)
    {
        $this->language = $language;
        $this->menu     = $menu;
        $this->menuItem = $menuItem;
        $this->slugify  = $slugify;
    }

    /**
     * @return array
     */
    public function getHeaderMenu($localeId)
    {
        return $this->getMenuById(1, $localeId);
    }

    /**
     * @return array
     */
    public function getFooterMenu($localeId)
    {
        return $this->getMenuById(2, $localeId);
    }

    /**
     * @param $array_with_elements
     * @param $wp_post
     * @return array
     */
    public function getChildId($array_with_elements, $wp_post)
    {
        return $this->add_children($array_with_elements, $wp_post['id']);;
    }

    /**
     * @param $array_with_elements
     * @param $level
     * @return array
     */
    function add_children($array_with_elements, $level) {
        $nested_array = array();
        foreach($array_with_elements[$level] as $wp_post){
            $obj = new \stdClass();
            $obj->id = $wp_post['id'];
            if(isset($array_with_elements[$wp_post['id']])){
                $obj->children = $this->getChildId($array_with_elements, $wp_post);
            }
            $nested_array[] = $obj;
        }
        return $nested_array;
    }

    /**
     * @param $menus
     * @return false|string
     */
    public function showMenuItem($menus)
    {
        $array_with_elements = array();

        foreach($menus as $data) {
            $array_with_elements[$data->parent][] = $data;
        }

        $return_arr = $this->add_children($array_with_elements, 0);

        return json_encode($return_arr);
    }

    /**
     * @param $languageId
     * @return Builder[]|Collection
     */
    public function getAllMenuItemByLanguageId($languageId)
    {
        return $this->menuItem->with(['menu', 'child'])
            ->where('language', $languageId)
            ->orderBy('sort', 'ASC')->get();
    }
    
    /**
     * getMenuById
     *
     * @param  mixed $menuId
     * @return void
     */
    public function getMenuById($menuId, $localeId)
    {
        $items = $this->menuItem->where('menu_id', $menuId)->where('language', (int) $localeId)->orderBy('sort')->get();
        return self::showMenu($items, $localeId);
    }

    /**
     * show Navigation Menu
     *
     * @param mixed $items
     * @param mixed $language
     * @param integer $parent
     * @return void
     */
    private function showMenu($items, $language, $parent = 0)
    {
        $data_arr = array();
        $i = 0;

        $items->load('child');

        foreach ($items as $item) {
            if ($item['language'] == $language) {
                if ($item['parent'] == $parent) {
                    $data_arr[$i] = $item->toArray();    
                    $data_arr[$i]['child'] = array();

                    if ($item['child']->count() > 0) {
                        $data_arr[$i]['child'] = self::showMenu($item->child, $language, $item['id']);
                    }
                }
            }

            $i++;
        }

        return $data_arr;
    }

    /**
     * Save Menu
     *
     * @param mixed $request
     * @return void
     */
    public function saveMenu($request)
    {
        $languages = $this->language->select('id')->where('active', 'y')->get();

        foreach($languages as $lagunguage) {
            $language_id[] = $lagunguage->id;
        }

        return $this->menu->create([
            'name' => strip_tags($request->name),
        ])->languages()->sync($language_id);
    }

    /**
     * Save Item Menu
     *
     * @param mixed $request
     * @return void
     */
    public function saveItemMenu($request)
    {
        $explodeLinkMenuArr = explode('/', request('url'));

        foreach($explodeLinkMenuArr as $key => $value){
            if($value == end($explodeLinkMenuArr)){
                $explodeLinkMenuArr[$key] = $this->slugify->slugify(end($explodeLinkMenuArr));
            }
        }

        $link = implode('/', $explodeLinkMenuArr);

        return $this->menuItem->create([
            'label'    => request('label'),
            'link'     => $link,
            'menu_id'  => request('menu'),
            'language' => request('language')
        ]);
    }

    /**
     * Update Menu
     *
     * @param mixed $request
     * @return void
     */
    public function modifyMenu($request, $id)
    {
        $arraydata = json_decode($request->menu, true);

        function saveMenuItem($array, $level = 0, $id = 0)
        {
            foreach ($array as $key => $value) {
                $menuitem = MenuItem::find($value['id']);
                if ($menuitem) {
                    $menuitem->parent = $id;
                    $menuitem->sort = $key;
                    $menuitem->depth = $level;
                    $menuitem->save();
                    if (array_key_exists('children', $value)) {
                        saveMenuItem($value['children'], $level + 1, $value['id']);
                    }
                }
            }
        }

        return saveMenuItem($arraydata);
    }

    /**
     * Update Item Menu
     *
     * @param mixed $request
     * @param mixed $id
     * @return void
     */
    public function modifyItemMenu($request, $id)
    {
        $explodeLinkMenuArr = explode('/', $request->url);

        $slugify = new Slugify();

        foreach($explodeLinkMenuArr as $key => $value){
            if($value == end($explodeLinkMenuArr)){
                $explodeLinkMenuArr[$key] = $slugify->slugify(end($explodeLinkMenuArr));
            }
        }

        $link = implode('/', $explodeLinkMenuArr);

        $menuitem = $this->menuItem->find($id);
        $menuitem->link = $link;
        $menuitem->label = $request->label;
        $menuitem->class = $request->class;
        
        return $menuitem->save();
    }
}
