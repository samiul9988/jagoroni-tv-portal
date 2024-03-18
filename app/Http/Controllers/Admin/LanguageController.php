<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LanguagesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use App\Services\LanguageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Support\Facades\{Gate, Validator};
use Spatie\TranslationLoader\LanguageLine;

class LanguageController extends Controller
{
    private $languageService;
    
    /**
     * __construct
     *
     * @param  mixed $languageService
     * @return void
     */
    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;

        $this->middleware('permission:read-languages', ['except' => ['showLanguage', 'showGroup', 'dataSelectOption']]);
        $this->middleware('permission:add-languages', ['only' => ['store']]);
        $this->middleware('permission:update-languages', ['only' => ['setActive', 'update']]);
        $this->middleware('permission:delete-languages', ['only' => ['destroy', 'massdestroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(LanguagesDataTable $dataTable)
    {
        return $dataTable->render( 'admin.languages.index' );
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
            'language' => 'required',
            'country' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $this->languageService->save();

        return response()->json(['success' => __('message.saved_successfully')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param Language $language
     * @return Application
     */
    public function edit(Language $language)
    {
        if ($language->default == 'y') {
            abort(403);
        }

        $countries = json_decode(file_get_contents(storage_path('app/public/file/countries.json')), true);

        return view('admin.languages.edit', compact('language','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LanguageRequest $request
     * @param Language $language
     * @return void
     */
    public function update(LanguageRequest $formRequest, Language $language)
    {
        $formRequest->validated();

        $this->languageService->modify($language);

        return redirect()->route('languages.index')->withSuccess(__('message.updated_successfully'));
    }
    
    /**
     * showLanguage
     *
     * @return void
     */
    public function showLanguage()
    {
        $keyword = strip_tags(request()->get('q'));
        return Language::where("language", "LIKE", "%$keyword%")->get();
    }
    
    /**
     * showGroup
     *
     * @return void
     */
    public function showGroup()
    {
        return LanguageLine::select('group')->groupBy('group')->get();
    }

    /**
     * @return JsonResponse
     */
    public function dataSelectOption()
    {
        $data = Language::select('id', 'language', 'name', 'active')->whereActive('y')->get();
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     */
    public function setActive(Language $language)
    {
        if ($language->default === 'y') {
            return response()->json(['error' => __('message.default_language_cannot_be_changed')]);
        }

        $message = '';

        if ($language->active == 'y' && request('active') == 'n') {
            $message = $language->name .' '. __('message.deactivated_successfully');
        } else if ($language->active == 'n' && request('active') == 'y'){
            $message = $language->name .' '. __('message.activated_successfully');
        }

        $language->update(['active' => request('active')]);

        return response()->json(['success' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Language $language
     * @return JsonResponse
     */
    public function destroy(Language $language)
    {
        if (!Gate::allows('delete-languages')) {
            return response()->json(['error' =>  __('message.dont_have_permission')]);
        }

        if ($language->language === config('settings.theme_language')) {
            return response()->json(['error' => __('message.language_is_used')]);
        }

        $delete = $this->languageService->remove($language);

        if ($delete->delete()) {
            return response()->json(['success' => __('message.deleted_successfully')]);
        } else {
            return response()->json(['error' => __('message.deleted_not_successfully')]);
        }
    }

    /**
     * Remove the multi resource from storage.
     *
     * @return JsonResponse
     */
    public function massdestroy()
    {
        if (!Gate::allows('delete-languages')) {
            return response()->json(['error' =>  __('message.dont_have_permission')]);
        }

        $languages = $this->languageService->massRemove();

        if ($languages->delete()) {
            return response()->json(['success' => __('message.deleted_successfully')]);
        } else {
            return response()->json(['error' => __('message.deleted_not_successfully')]);
        }
    }

}
