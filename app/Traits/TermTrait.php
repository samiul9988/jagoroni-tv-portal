<?php

namespace App\Traits;

use App\Models\{Language, Term};
use App\Services\TermService;
use Carbon\Carbon;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Arr;

trait TermTrait
{
    protected $slugify, $termService, $term, $language;
        
    /**
     * __construct
     *
     * @param  mixed $slugify
     * @param  mixed $termService
     * @param  mixed $term
     * @param  mixed $language
     * @return void
     */
    public function __construct(Slugify $slugify, TermService $termService, Term $term, Language $language)
    {
        $this->slugify = $slugify;
        $this->termService = $termService;
        $this->term = $term;
    }

    /**
     * @param $language
     * @param $slug
     * @return mixed
     */
    public function getCategoryId($language, $slug)
    {
        return $this->term->select('id')
            ->category()->where('slug', $slug)
            ->where('language_id', $language)
            ->first()
            ->id;
    }

    /**
     * @param $language
     * @param $slug
     * @return mixed
     */
    public function getTagId($language, $slug)
    {
        return $this->term->select('id')
            ->tag()->where('slug', $slug)
            ->where('language_id', $language)
            ->first()
            ->id;
    }

    /**
     * @param $request
     * @return array
     */
    public function getTranslationFromInput($request)
    {
        return Arr::add($request->translation,
            $this->language->where('id', $request->language)->first()->language,
            $request->name
        );
    }

    /**
     * @param $term
     * @return array
     */
    public function getTranslationFromDB($term)
    {
        return Arr::add(json_decode($term->translation,true),
            $this->language->where('id', $term->language_id)->first()->language,
            $term->slug
        );
    }

    /**
     * @param $taxonomy
     * @param $slug
     * @param $language
     * @return mixed
     */
    public function checkExist($taxonomy, $slug, $language)
    {
        return $this->term->where('taxonomy', $taxonomy)
            ->where('slug',  $slug)
            ->where('language_id', $language)
            ->exists();
    }

    /**
     * @param $taxonomy
     * @param $slug
     * @param $language
     * @param $id
     * @return mixed
     */
    public function checkExistUpdate($taxonomy, $slug, $language, $id)
    {
        return $this->term->where('taxonomy', $taxonomy)
            ->where('slug', $slug)
            ->where('language_id', $language)
            ->whereNot('id',$id)
            ->exists();
    }

    /**
     * @param $name
     * @param $taxonomy
     * @param $language
     * @param $translation
     * @param $request
     * @return array
     */
    public function getDataTranslation($name, $taxonomy, $language, $translation, $request)
    {
        foreach($translation as $key => $val) {
            $translation[$key] = $this->slugify->slugify($val);
        }

        if ($request->filled('parent')) {
            $parent = $this->getTransTermIdByTermId($request->parent, $language);
        } else {
            $parent = 0;
        }

        $data = [
            'name'        => $name,
            'slug'        => $this->slugify->slugify($name),
            'taxonomy'    => $taxonomy,
            'parent'      => $parent,
            'description' => NULL,
            'language_id' => $language,
            'translation' => json_encode($translation),
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now()
        ];

        if ($request->fileName) {
            $data = array_merge($data, ['image' => $request->fileName]);
        } else {
            $data = array_merge($data, ['image' => null]);
        }

        return $data;
    }

    /**
     * @param $request
     * @param $taxonomy
     * @return array
     */
    public function getData($request, $taxonomy)
    {
        $data = [
            'name'        => $request->name,
            'slug'        =>  $this->slugify->slugify($request->name),
            'taxonomy'    => $taxonomy,
            'parent'      => $request->filled('parent') ? (int)$request->parent : '0',
            'description' => $request->description,
            'language_id' => $request->language,
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now()
        ];

        if ($request->fileName) {
            $data = array_merge($data, ['image' => $request->fileName]);
        }

        return $data;
    }

    /**
     * @param $request
     * @param $taxonomy
     * @return array
     */
    public function getDataUpdate($request, $taxonomy)
    {
        $data = [
            'name'        => $request->name,
            'slug'        => $this->slugify->slugify($request->name), 
            'taxonomy'    => $taxonomy,
            'parent'      => $request->has('parent') ? (int)$request->parent : '0',
            'description' => $request->description,
            'language_id' => $request->language,
            'updated_at'  => Carbon::now()
        ];

        if ($request->fileName) {
            if ($request->fileName == 'remove') {
                $data = array_merge($data, ['image' => NULL]);
            } else {
                $data = array_merge($data, ['image' => $request->fileName]);
            }
        } else {
            $data = array_merge($data);
        }


        return $data;
    }

    /**
     * @param $request
     * @param $data
     * @return array
     */
    public function addDataTranslationToTerm($request, $data)
    {
        $translations = $request->translation;
        foreach($translations as $key => $value){
            if (Arr::get($translations, $key)) {
                $translations[$key] =   $this->slugify->slugify($value);
            } else {
                unset($translations[$key]);
                unset($translations['slug'][$key]);
            }
        }

        return Arr::add($data, 'translation', json_encode($translations));
    }

    /**
     * @param $data
     * @return array
     */
    public function addDataTranslationUpdate($data)
    {
        if (request()->has('translation')) {
            $translations = request('translation');
            foreach($translations as $key => $value){
                if ($translations[$key]) {
                    $translations[$key] = $this->slugify->slugify($value);
                } else {
                    unset($translations[$key]);
                }
            }
            $data = Arr::add($data, 'translation', json_encode($translations));
        }

        $translations = request('translation');
        foreach($translations as $key => $value){
            if ($translations[$key]) {
                $translations[$key] = $this->slugify->slugify($value);
            } else {
                unset($translations[$key]);
            }
        }

        return Arr::add($data, 'translation', json_encode($translations));
    }

    /**
     * @param $parent
     * @param $langId
     * @return mixed
     */
    public function getTransTermIdByTermId($parent, $langId)
    {
        $language = $this->language->find($langId);
        $langCode = $language->language;

        $term = $this->term->find($parent);
        $slug = json_decode($term->translation)->{$langCode};

        $transTerm = $this->term->firstWhere('slug', $slug);

        return $transTerm->id;
    }

    /**
     * @param $languageCode
     * @param $name
     * @return mixed
     */
    public function getCategoryIdByLanguageCode($languageCode, $name)
    {
        $languageId = $this->getLanguageIdByCode($languageCode);
        return $this->term->select('id')
            ->category()->where('name', $name)
            ->where('language_id', $languageId)
            ->first()
            ->id;
    }

    /**
     * @param $languageCode
     * @param $name
     * @return mixed
     */
    public function getTagIdByLanguageCode($languageCode, $name)
    {
        $languageId = $this->getLanguageIdByCode($languageCode);
        return $this->term->select('id')
            ->tag()->where('name', $name)
            ->where('language_id', $languageId)
            ->first()
            ->id;
    }

    /**
     * @param $theme
     * @param $layout
     * @param $widget
     * @return mixed
     */
    public function getTerms($theme, $layout, $widget)
    {
        return $this->termService->dynamicQuerySection($theme, $layout, $widget);
    }
}
