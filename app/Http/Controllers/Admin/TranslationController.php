<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\{Collection, Str};
use Illuminate\Support\Facades\App;
use JoeDixon\Translation\Drivers\Translation;

class TranslationController extends Controller
{
    private $translation;

    /**
     * @param Translation $translation
     */
    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function index(Request $request)
    {
        $language = App::currentLocale();

        if ($request->has('language') && $request->get('language') !== $language) {
            return redirect()
                ->route('languages.translations.index', ['language' => $request->get('language'), 'group' => $request->get('group'), 'filter' => $request->get('filter')]);
        }

        $languages = $this->translation->allLanguages();
        $groups = $this->translation->getGroupsFor(App::currentLocale());
        $translations = $this->translation->filterTranslationsFor($language, $request->get('filter'));

        if ($request->has('group') && $request->get('group')) {
            $translations = $translations->get('group')->filter(function ($values, $group) use ($request) {
                return $group === $request->get('group');
            });

            $translations = new Collection(['group' => $translations]);
        }

        return view('admin.translations.index', compact('language', 'languages', 'groups', 'translations'));
    }

    /**
     * @return mixed
     */
    public function getGroupTranslation()
    {
        return $this->translation->getGroupsFor(App::currentLocale())->merge('single');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getDataTable(Request $request)
    {
        $language = App::currentLocale();

        if ($request->has('language')) {
            $language = $request->language;
        }

        $translations = $this->translation->filterTranslationsFor($language, $request->get('filter'));

        if ($request->has('group') && $request->get('group')) {
            if ($request->get('group') === 'single') {
                $translations = $translations->get('single');
                $translations = new Collection(['single' => $translations]);
            } else {
                $translations = $translations->get('group')->filter(function ($values, $group) use ($request) {
                    return $group === $request->get('group');
                });
                $translations = new Collection(['group' => $translations]);
            }
        }

        $response = [
            'data' => $translations,
            'language' => $language
        ];

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @param $language
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(Request $request, $language)
    {
        return view('admin.translations.create', compact('language'));
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @param  mixed $language
     * @return void
     */
    public function store(TranslationRequest $request, $language)
    {
        $isGroupTranslation = $request->filled('group');

        $this->translation->add($request, $language, $isGroupTranslation);

        return redirect()
            ->route('translations.index')
            ->with('success', __('translation::translation.translation_added'));
    }

    /**
     * @param Request $request
     * @param $language
     * @return true[]
     */
    public function update(Request $request, $language)
    {
        $isGroupTranslation = ! Str::contains($request->get('group'), 'single');

        $this->translation->add($request, $language, $isGroupTranslation);

        return response()->json(['success' => __('message.updated_successfully')]);
    }
}
