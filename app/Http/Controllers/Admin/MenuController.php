<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Language, Menu, MenuItem};
use App\Services\MenuService;
use App\Traits\LanguageTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller 
{
    use LanguageTrait;
    private $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
        $this->middleware('permission:read-menus');
        $this->middleware('permission:add-menus', ['only' => ['store', 'storeItemMenu']]);
        $this->middleware('permission:delete-menus', ['only' => ['destroy', 'deleteitemmenu']]);
        $this->middleware('permission:update-menus', ['only' => ['updateMenuStructure', 'updateItemMenu']]);
    }

    /**
     * @param Request $request
     * @param $menu_id
     * @return JsonResponse
     */
    public function selectLanguageItemMenu(Request $request, $menu_id)
    {
        $languageCode = $this->getLanguageCodeById(request('language'));
        return response()->json([
            'menu_id' => $menu_id,
            'lang' => $languageCode
        ]);
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return redirect()->route('menus.show.item', [
            'menu_id' => 1,
            'lang' => $this->getLanguageCodeByAuth()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|min:2|unique:menus'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $this->menuService->saveMenu($request);

        return response()->json(['success' => __('message.saved_successfully')]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeItemMenu(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'label' => 'required|min:2',
            'url' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $menu = $this->menuService->saveItemMenu($request);

        return response()->json(['success' => __('message.saved_successfully'), 'menu' => $menu]);
    }
    
    /**
     * showMenu
     *
     * @param  mixed $request
     * @return void
     */
    public function showMenu(Request $request)
    {
        return response()->json([
            'menu_id' => $request->menu,
            'lang' => $this->getLanguageCodeByAuth()
        ]);
    }

    /**
     * @param $menuId
     * @param $languageCode
     * @return Application|Factory|View
     */
    public function showMenuItem($id, $langCode)
    {
        $langId      = $this->getLanguageIdByCode($langCode);
        $menuOptions = Menu::pluck('name', 'id');
        $languages   = Language::pluck('name', 'id');
        $json        = $this->menuService->getMenuById($id, $langId);

        return view('admin.menu.menuitem', compact('json', 'id', 'langId', 'langCode', 'menuOptions', 'languages'));
    }
    
    /**
     * menulist
     *
     * @param  mixed $menu_id
     * @param  mixed $lang
     * @return void
     */
    public function menulist($menu_id, $lang)
    {
        $id = (int) $menu_id;
        $languageId = Language::whereLanguage($lang)->first()->id;
        
        $menus = MenuItem::with('child')
                ->where('menu_id', $menu_id)
                ->where('language', $languageId)
                ->where('parent', 0)->orderBy('sort', 'ASC')
                ->get();

        return view('admin.menu.menulist', compact('menus', 'id'));
    }
    
    /**
     * editItemMenu
     *
     * @param  mixed $menu_id
     * @param  mixed $item_id
     * @return void
     */
    public function editItemMenu($menu_id, $item_id)
    {
        $items = MenuItem::find($item_id);
        return response()->json(['data' => $items]);
    }
    
    /**
     * updateMenuStructure
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updateMenuStructure(Request $request, $id)
    {
        $this->menuService->modifyMenu($request, $id);

        return response()->json(['success' => __('message.updated_successfully')]);
    }

     /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateItemMenu(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'label' => 'required|min:3',
            'url' => 'required',
            'class' => 'nullable|alpha_num'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $this->menuService->modifyItemMenu($request, $id);

        return response()->json(['success' => __('message.updated_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        Menu::destroy($id);
        return response()->json(['success' => __('message.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function deleteitemmenu()
    {
        $menuitem = MenuItem::find(request('id'));
        $menuitem->delete();

        return response()->json(['success' => __('message.deleted_successfully')]);
    }
}
