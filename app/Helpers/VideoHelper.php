<?php

namespace App\Helpers;

use App\Models\Theme;
use App\Traits\{LanguageTrait, PostTrait};
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

Class VideoHelper
{
    /**
     * @param $postLangCode
     * @param $translations
     * @return bool
     */
    public static function checkExistsTrans($postLangCode, $translations)
    {
        $arrTranslations = json_decode($translations, true);

        return Arr::exists($arrTranslations, $postLangCode);
    }

    /**
     * @param $lang
     * @param $translations
     * @return array|\ArrayAccess|mixed
     */
    public static function getTransPostId($lang, $translations)
    {
        $language =  (new class { use LanguageTrait; })->getLanguageCodeById($lang);

        return Arr::get(json_decode($translations, true), $language);
    }

    /**
     * @param $langId
     * @param $translations
     * @return string
     */
    public static function showTransPostTitle($langId, $translations)
    {
        $language =  (new class { use LanguageTrait; })->getLanguageCodeById($langId);
        $lang_exists = Arr::exists(json_decode($translations, true), $language);

        if ($lang_exists) {
            $post_id_translation = Arr::get(json_decode($translations, true), $language);
            return (new class { use PostTrait; })->getPostTitleById($post_id_translation);
        } else {
            return '';
        }
    }


    /**
     * Show Thumbnail
     *
     * @param mixed $post
     * @param mixed $size
     * @return void
     */
    public static function showThumbnail($post, $size=null) {
        $image = asset('img/cover-video.webp');

        $path = $size ?  '/' . $size . '/' : '/';

        if ($post->post_image AND ImageHelper::isExists('images', $post->post_image) AND $size) {
            (new class { use PostTrait; })->generateAnotherSizePostThumbnailIfNotExists($post, $size);
        }

        $postImageMeta = PostHelper::isImageUrlAvailable($post);

        if ($postImageMeta) {
            $image = json_decode($post->post_image_meta)->image_url;
        } else {         
            if (!empty($post->post_image) && ImageHelper::isExists('images' . $path, $post->post_image)) {
                $image = asset('storage/images'. $path . $post->post_image);
            }
        }

        return $image;
    }

    /**
     * @param $num
     * @return string
     */
    public static function createParagraph($num)
    {
        $faker = Faker::create();

        $paragraphps = $faker->paragraphs($num);

        foreach($paragraphps as $paragraph){
            $p[] = '<p>'. $paragraph .'</p>';
        }

        return implode('', $p);
    }

    /**
     * @param $num
     * @return string
     */
    public static function createKeyword($num)
    {
        $faker = Faker::create();

        $words = $faker->words($num);

        foreach($words as $word){
            $p[] = $word;
        }

        return implode(', ', $p);
    }

    public static function getQuery($page, $layout, $widget)
    {
        $theme = Theme::whereTheme('magz')->whereSlug($page);
        return (new class { use PostTrait; })->getArticles($theme, $layout, $widget);
    }

    /**
     * @param $post
     * @return string|void
     */
    public static function getUriPost($post)
    {
        return UtlHelper::resolvePostUrl($post);
    }

    /**
     * @param $page
     * @return string|void
     */
    public static function getUriPage($page)
    {
        if (Schema::hasTable('settings')) {
            if (config('settings.page_permalink_type')) {
                return route('page.show', compact('page'));
            }else{
                abort(404);
            }
        }
    }

    /**
     * @param $category
     * @return string|void
     */
    public static function getUriCategory($category)
    {
        if (Schema::hasTable('settings')) {
            if (config('settings.category_permalink_type')) {
                return route('category.show', compact('category'));
            }
        }else{
            abort(404);
        }
    }
}
