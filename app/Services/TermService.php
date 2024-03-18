<?php

namespace App\Services;

use App\Models\{Language, Term, Theme};
use App\Traits\{ImageTrait, LanguageTrait, TermTrait};
use Cocur\Slugify\Slugify;
use Illuminate\Support\{Arr, Str};
use Psr\Container\{ContainerExceptionInterface, NotFoundExceptionInterface};

Class TermService
{
    use ImageTrait, LanguageTrait, TermTrait;

    protected $term, $slugify, $language;

    /**
     * @param Language $language
     * @param Term $term
     * @param Slugify $slugify
     */
    public function __construct(Language $language, Term $term, Slugify $slugify)
    {
        $this->language = $language;
        $this->term = $term;
        $this->slugify = $slugify;
    }
    
    /**
     * save
     *
     * @param  mixed $request
     * @param  mixed $taxonomy
     * @param  mixed $resp
     * @return void
     */
    public function save($request, $taxonomy, $resp)
    {
        if (request()->hasFile('image')) {
            $request->merge([
                'fileName' => $this->uploadCategoryImage($request->image)
            ]);
        }

        $responseTrans = null;

        if (request()->has('translation')) {
            $responseTrans = $this->addTranslation($request, $taxonomy);

            if ($resp) {
                $resp[] =  Arr::collapse($responseTrans);

                $resp = ['errors' => [
                    'status' => 'error',
                    'data' => $resp
                ]];
            } elseif (Arr::exists($responseTrans, 'status')) {
                if (Arr::exists(Arr::collapse($responseTrans), 'validateTrans')) {
                    $resp[] = Arr::collapse($responseTrans);

                    $resp = ['errors' => [
                        'status' => 'error',
                        'data' => $resp
                    ]];
                } else {
                    $resp = Arr::collapse($responseTrans);
                }
            }
        } else {
            if ($resp) {
                $resp = ['errors' => [
                    'status' => 'error',
                    'data' => $resp
                ]];
            }
        }

        if ($resp) {
            foreach ($resp as $stat) {
                if ($stat['status'] == 'error') {
                    return response()->json($resp);
                }
            }
        } else {
            $this->insert($request, $taxonomy, $responseTrans);
        }

        return response()->json(['success' => __('message.saved_successfully')]);        
    }
    
    /**
     * modify
     *
     * @param  mixed $request
     * @param  mixed $term
     * @param  mixed $taxonomy
     * @param  mixed $resp
     * @return void
     */
    public function modify($request, $term, $taxonomy, $resp)
    {
        if (request()->hasFile('image')) {
            if (!empty($term->image)) {
                $this->diskStorage()->delete('images/' . $term->image);
            }
            $request->merge([
                'fileName' => $this->uploadCategoryImage($request->image)
            ]);
        } else {
            if (request('isupload') == "remove") {
                if (!empty($term->image)) {
                    $this->diskStorage()->delete('images/' . $term->image);
                }
                $request->merge([
                    'fileName' => 'remove'
                ]);
            }
        }

        if (request()->has('translation')) {
            $respTrans[] = $this->addTranslationUpdate($request, $term, $taxonomy);

            if ($resp) {
                $resp[] =  Arr::collapse($respTrans);

                $resp = ['errors' => [
                    'status' => 'error',
                    'data' => $resp
                ]];
            } else {
                if (Arr::exists(Arr::collapse($respTrans), 'validateTrans')) {
                    $resp[] = Arr::collapse($respTrans);

                    $resp = ['errors' => [
                        'status' => 'error',
                        'data' => $resp
                    ]];
                } else {
                    $resp = Arr::collapse($respTrans);
                }
            }
        } else {
            if ($resp) {
                $resp = ['errors' => [
                    'status' => 'error',
                    'data' => $resp
                ]];
            } 
        }

        $data = $this->insertUpdate($request, $term, $taxonomy);
        
        if ($resp) {
            foreach ($resp as $stat) {
                if ($stat['status'] == 'update') {
                    $this->term->find($stat['id'])->update($stat['data']);
                    $term->update($data);
                } else if ($stat['status'] == 'delete') {
                    $this->term->find($stat['id'])->delete();
                    $term->update($data);
                } else if ($stat['status'] == 'create') {
                    $this->term->create($stat['data']);
                    $term->update($data);
                } else {
                    return response()->json($resp);
                }
            }
        } else {
            $term->update($data);
        }

        return response()->json(['success' => __('message.updated_successfully')]);
    }
    
    /**
     * addTranslation
     *
     * @param  mixed $request
     * @param  mixed $taxonomy
     * @return void
     */
    public function addTranslation($request, $taxonomy)
    {
        $translations =  $this->getTranslationFromInput($request);

        foreach($translations as $key => $value){
            $translations['slug'][$key] = $this->slugify->slugify($value);
        }

        $data = [];
        $validate = [];

        foreach($translations as $key => $value){
            if (Arr::get(request('translation'), $key)) {
                $check_term = $this->checkExist($taxonomy, $this->slugify->slugify($value), $this->getLanguageIdByCode($key));
                
                $check_length = Str::length($value);

                if ($check_term OR $check_length < 3) {
                    if ($check_term) {
                        $validate[] = ['error_translation' => __('validation.unique', ['attribute' => $value]), 'error_lang' => $key];
                    }

                    if ($check_length < 3) {
                        $validate[] = ['error_translation' => __('validation.min.string', ['attribute' => $value, 'min' => 3]), 'error_lang' => $key];
                    }
                } else {
                    if(key($translations['slug']) == $key){
                        unset($translations['slug'][$key]);
                    }

                    $transData = array_filter($translations['slug'], fn($value) => !is_null($value) && $value !== '');

                    $data[] = $this->getDataTranslation($value, $taxonomy, $this->getLanguageIdByCode($key), $transData, $request);

                    $translations['slug'][$key] = $value;
                }
            } else {
                unset($translations[$key]);
                unset($translations['slug'][$key]);
            }
        }

        return $validate ? ['status' => 'error', 'data' => ['validateTrans' => $validate]] : $data;
    }
    
    /**
     * addTranslationUpdate
     *
     * @param  mixed $request
     * @param  mixed $term
     * @param  mixed $taxonomy
     * @return void
     */
    public function addTranslationUpdate($request, $term, $taxonomy)
    {
        $translations = Arr::add($request->translation,
            Language::where('id', $request->language)->first()->language,
            $request->name
        );

        $getTranslations = Arr::add(json_decode($term->translation,true), $this->getLanguageCodeById($term->language_id), $term->slug);

        foreach ($getTranslations as $y => $z) {
            $idterm = $this->term->where('taxonomy', $taxonomy)
                ->where('slug', $z)
                ->where('language_id', $this->getLanguageIdByCode($y))->first()->id;

            $getIdTrans[$y] = $idterm;
        }

        $validate = [];
        $status = [];

        foreach($translations as $key => $value){
            if (Arr::get(request('translation'), $key)) {
                if (key($translations) == $key) {
                    unset($translations[$key]);
                }

                $translation = array_filter($translations, fn($value) => !is_null($value) && $value !== '');

                $exists = Arr::exists($getTranslations, $key);

                $data = $this->getDataTranslation($value, $taxonomy, $this->getLanguageIdByCode($key), $translation, $request);
                
                if (!$exists) {
                    $isTermExist = $this->checkExist($taxonomy, $this->slugify->slugify($value), $this->getLanguageIdByCode($key));

                    $check_length = Str::length($value);

                    if ($isTermExist or $check_length < 3) {
                        if ($isTermExist) {
                            $validate[] = ['error_translation' => __('validation.unique', ['attribute' => $value]), 'error_lang' => $key];
                        }

                        if ($check_length < 3) {
                            $validate[] = ['error_translation' => __('validation.min.string', ['attribute' => $value, 'min' => 3]), 'error_lang' => $key];
                        }
                    } else {
                        if ($request->fileName) {
                            if ($term->image) {
                                $data = array_merge($data, ['image' => $term->image]);
                            }
                        } else {
                            $data = array_merge($data, ['image' => NULL]);
                        }
                        
                        $status[] = [
                            'status' => 'create',
                            'data'   => $data
                        ];
                    }
                } else {
                    $isTermExist = $this->checkExistUpdate($taxonomy, $this->slugify->slugify($value), $this->getLanguageIdByCode($key), Arr::get($getIdTrans, $key));

                    $check_length = Str::length($value);

                    if ($isTermExist or $check_length < 3) {
                        if ($isTermExist) {
                            $validate[] = ['error_translation' => __('validation.unique', ['attribute' => $value]), 'error_lang' => $key];
                        }
                        if ($check_length < 3) {
                            $validate[] = ['error_translation' => __('validation.min.string', ['attribute' => $value, 'min' => 3]), 'error_lang' => $key];
                        }
                    } else {

                        $slug = Arr::get(json_decode($term->translation, true), $key);
                        $id = Arr::get($getIdTrans, $key);
                        
                        $status[] = [
                            'status' => 'update',
                            'id'     => $id,
                            'slug'   => $slug,
                            'data'   => $data
                        ];
                    }
                }
                $translations[$key] = $value;
            } else {
                $slug = Arr::get(json_decode($term->translation, true), $key);
                $id = Arr::get($getIdTrans, $key);
                if ($slug) {
                    $status[] = [
                        'status' => 'delete',
                        'id'     => $id,
                        'slug'   => $slug
                    ];
                }
                unset($translations[$key]);
            }
        }

        if ($validate) {
            $status = ['validateTrans' => $validate];
        }

        return $status;
    }
    
    /**
     * insert
     *
     * @param  mixed $request
     * @param  mixed $taxonomy
     * @param  mixed $data
     * @return void
     */
    public function insert($request, $taxonomy, $data)
    {
        $dataItem = $this->getData($request, $taxonomy);

        if ($request->has('translation')) {
            $dataItem = $this->addDataTranslationToTerm($request, $dataItem);
        }

        $data[] = $dataItem;

        return $this->term->insert($data);
    }
    
    /**
     * insertUpdate
     *
     * @param  mixed $request
     * @param  mixed $term
     * @param  mixed $taxonomy
     * @return void
     */
    public function insertUpdate($request, $term, $taxonomy)
    {
        $data = $this->getDataUpdate($request, $taxonomy);

        if ($request->has('translation')) {
            $data = $this->addDataTranslationUpdate($data);
        }

        return $data;
    }
    
    /**
     * categoryCount
     *
     * @return void
     */
    public function categoryCount()
    {
        return $this->term->where('taxonomy', 'category')->count();
    }
    
    /**
     * tagCount
     *
     * @return void
     */
    public function tagCount()
    {
        return $this->term->where('taxonomy', 'tag')->count();
    }
    
    /**
     * remove
     *
     * @param  mixed $term
     * @param  mixed $taxonomy
     * @return void
     */
    public function remove($term, $taxonomy)
    {
        if ($term->translation) {
            $translations = json_decode($term->translation,true);

            foreach ($translations as $key => $value) {
                if (key($translations) == $key) {
                    unset($translations[$key]);
                }

                if ($value == $term->slug) {
                    unset($translations[$key]);
                }

                $trans = [];
                foreach ($translations as $k => $val) {
                    $trans[$k] = $val;
                }

                $data = [
                    'translation' => $translations ? json_encode($translations) : null
                ];

                $slug = Arr::get(json_decode($term->translation, true), $key);
                $this->term->where('taxonomy', $taxonomy)->where('slug', $slug)->update($data);
                $translations[$key] = $value;
            }
        }

        if ($term->image) {
            if (!$term->translation) {
                $this->deleteImage('images', $term->image);
            }
        }

        if ($term->children) {
            $term->children()->delete();
        }

        $term->delete();
    }


    /**
     * massRemove
     *
     * @param  mixed $taxonomy
     * @var Term $terms
     * @return void
     */
    public function massRemove($taxonomy)
    {
        $term_id_array = request('id');

        $terms = $this->term->whereIn('id', $term_id_array);

        $this->term->whereIn('parent', $term_id_array)
            ->update(['parent' => '0']);

        foreach($terms->get() as $term){
            if ($term->translation) {
                $translations = json_decode($term->translation,true);

                foreach ($translations as $key => $value) {
                    if (key($translations) == $key) {
                        unset($translations[$key]);
                    }

                    if ($value == $term->slug) {
                        unset($translations[$key]);
                    }

                    $trans = [];
                    foreach ($translations as $k => $val) {
                        $trans[$k] = $val;
                    }

                    $data = [
                        'translation' => $translations ? json_encode($translations) : null
                    ];

                    $slug = Arr::get(json_decode($term->translation, true), $key);
                    $this->term->where('taxonomy', $taxonomy)->where('slug', $slug)->update($data);
                    $translations[$key] = $value;
                }
            }

            if ($term->image) {
                if (!$term->translation) {
                    $this->diskStorage('images', $term->image);
                }
            }

            if ($term->children) {
                $term->children()->delete();
            }
        }

        return $terms;
    }

    /**
     * @param $taxonomy
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function showTermForSelectOption($taxonomy)
    {
        $language = request('lang');
        $hasParent = request()->has('c');
        $hasType = request()->has('t');

        $data = $this->term->where('taxonomy', $taxonomy);

        if ($hasType) { // subcategory
            $data->subcategory();
                if ($hasParent) {
                    $data->whereIn('parent', request('c', ));
                } else {
                    $data->whereParent(0);
                }
        } else {
            $data->whereParent(0);
        }

        if(request()->filled('q')) {
            $data->searchName(request()->get('q'));
        }

        return $data->where('language_id', $language)
            ->orderBy('id', 'DESC')
            ->get(['id', 'name']);
    }
  
    /**
     * getTag
     *
     * @return void
     */
    public function getTag()
    {
        return $this->term->tag();
    }
    
    /**
     * getCategory
     *
     * @return void
     */
    public function getCategory()
    {
        return $this->term->category();
    }
    
    /**
     * dynamicQuery
     *
     * @param  mixed $page
     * @param  mixed $layout
     * @param  mixed $widgetName
     * @param  mixed $widgetData
     * @return void
     */
    public function dynamicQuery($page, $layout, $widgetName, $widgetData)
    {
        $termType   = $widgetData['term_type'];
        $order      = $widgetData['order'];
        $popular    = $widgetData['popular_based'];
        $numOfPosts = $widgetData['number_of_posts'];

        if ($termType == 'category') {
            $query = Term::category()->currentLanguage()->whereHas('posts')->withCount('posts');
        } else {
            $query = Term::tag()->currentLanguage()->whereHas('posts')->withCount('posts');
        }

        if ($order == 'latest') {
            $query1 = $query->latest();
        } else if ($order == 'oldest') {
            $query1 = $query->oldest();
        } else if ($order == 'popular') {
            $query1 = $query->orderBy('posts_count', 'desc');
        } else {
            $query1 = $query->inRandomOrder();
        }

        if ($popular == 'none') {
            $query2 = $query1;
        } else if ($popular == 'all') {
            $query2 = $query1;
        } else if ($popular == 'day') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subDay());
        } else if ($popular == 'week') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subWeek());
        } else if ($popular == 'month') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth());
        } else if ($popular == 'year') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subYear());
        }

        return $query2->limit($numOfPosts)->get();
    }
    
    /**
     * dynamicQuerySection
     *
     * @param  mixed $layout
     * @param  mixed $widget
     * @return void
     */
    public function dynamicQuerySection($layout, $widget)
    {
        $theme      = Theme::whereTheme('magz')->whereSlug('home');
        $arrSetting = $theme->first()->setting;

        $termType   = Arr::get($arrSetting, $layout.'.widget.section.'.$widget.'.term_type');
        $order      = Arr::get($arrSetting, $layout.'.widget.section.'.$widget.'.order');
        $popular    = Arr::get($arrSetting, $layout.'.widget.section.'.$widget.'.popular_based');
        $numOfPosts = Arr::get($arrSetting, $layout.'.widget.section.'.$widget.'.number_of_posts');

        if ($termType == 'category') {
            $query = Term::category()->currentLanguage()->whereHas('posts')->withCount('posts');
        } else {
            $query = Term::tag()->currentLanguage()->whereHas('posts')->withCount('posts');
        }

        if ($order == 'latest') {
            $query1 = $query->latest();
        } else if ($order == 'oldest') {
            $query1 = $query->oldest();
        } else if ($order == 'popular') {
            $query1 = $query->orderBy('posts_count', 'desc');
        } else {
            $query1 = $query->inRandomOrder();
        }

        if ($popular == 'none') {
            $query2 = $query1;
        } else if ($popular == 'all') {
            $query2 = $query1;
        } else if ($popular == 'day') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subDay());
        } else if ($popular == 'week') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subWeek());
        } else if ($popular == 'month') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth());
        } else if ($popular == 'year') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subYear());
        }

        return $query2->limit($numOfPosts)->get();
    }
    
}
