<?php

namespace App\Helpers;

use App\Models\{Term, Theme};
use App\Services\TermService;
use Illuminate\Support\Arr;

Class TermHelper
{    
    /**
     * getQuery
     *
     * @param  mixed $page
     * @param  mixed $layout
     * @param  mixed $widget
     * @return void
     */
    public static function getQuery($page, $layout, $widget)
    {
        $theme = Theme::whereTheme('magz')->whereSlug($page);

        $term = new TermService;

        return $term->dynamicQuerySection($theme, $layout, $widget);
    }
    
    /**
     * getTermNameById
     *
     * @param  mixed $id
     * @return void
     */
    public static function getTermNameById($id)
    {
        $term = Term::find($id);

        return $term->name;
    }

    /**
     * Get ID By Slug
     *
     * @param mixed $slug
     * @return void
     */
    public static function getIdBySlug($slug)
    {
        $term = Term::whereSlug($slug)->first();

        return $term->id;
    }

    /**
     * Get Name By Slug
     *
     * @param mixed $slug
     * @return void
     */
    public static function getNameBySlug($slug)
    {
        $term = Term::whereSlug($slug)->first();

        return $term->name;
    }

    /**
     * Get ID translation By Slug
     *
     * @param mixed $term
     * @param mixed $language
     * @return void
     */
    public static function getIDTranslationBySlug($term, $language)
    {
        if ($term->translation) {
            $termTranslations = json_decode($term->translation, TRUE);

            if (Arr::exists($termTranslations, $language->language)) {
                $slug = $termTranslations[$language->language];
                return self::getIdBySlug($slug);
            }
        }
    }

    /**
     * Get Name translation By Slug
     *
     * @param mixed $term
     * @param mixed $language
     * @return void
     */
    public static function getNameTranslationBySlug($term, $language)
    {
        if ($term->translation) {
            $termTranslations = json_decode($term->translation, TRUE);

            if (Arr::exists($termTranslations, $language->language)) {
                $slug = $termTranslations[$language->language];
                return self::getNameBySlug($slug);
            }
        }
    }
    
    /**
     * getCategory
     *
     * @return void
     */
    public static function getCategory()
    {
        $languageId = LocalizationHelper::getCurrentLocaleAuthdId();
        return Term::whereTaxonomy('category')
            ->where('language_id', $languageId)->latest()->get();
    }

    /**
     * Get Category Name
     *
     * @param mixed $post
     * @return void
     */
    public static function categoryName($post)
    {
        return $post->terms->filter(function($item) {
            return $item->taxonomy == 'category';
        })->first()->name;
    }

    /**
     * Get Category URL
     *
     * @param mixed $post
     * @return void
     */
    public static function categoryUrl($post)
    {
        $slug = $post->terms->filter(function($item) {
            return $item->taxonomy == 'category';
        })->first()->slug;

        return route('category.show', $slug);
    }
    
    /**
     * resolveLabel
     *
     * @param  mixed $post
     * @param  mixed $slug
     * @return void
     */
    public static function resolveLabel($post, $slug)
    {
        $term = Term::category()->where('slug', $slug)->first();

        if ($term->parent > 0) {
            $category = Term::find($term->parent);

            $exists = $post->terms()->where('id', $term->parent)->exists();

            return $exists ? $category->name : $term->name;
        } else {
            return $term->name;
        }
    }
    
    /**
     * resolveUrl
     *
     * @param  mixed $post
     * @param  mixed $slug
     * @return void
     */
    public static function resolveUrl($post, $slug)
    {
        $term = Term::category()->where('slug', $slug)->first();

        if ($term->parent > 0) {
            $category = Term::find($term->parent);

            $exists = $post->terms()->where('id', $term->parent)->exists();

            if ($exists) {
                return route('category.show', $category->slug);
            } else {
                return route('subcategory.show', [$category->slug, $slug]);
            }

            return route('subcategory.show', [$category->slug, $slug]);
        } else {
            return route('category.show', $slug);
        }
    }
}
