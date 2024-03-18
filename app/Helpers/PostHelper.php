<?php

namespace App\Helpers;

use App\Models\Theme;
use App\Traits\{ImageTrait, LanguageTrait, PostTrait, StorageDiskTrait};
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\{File, Schema};
use Intervention\Image\Facades\Image;

Class PostHelper
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
     * @param object $post
     * @param mixed $size
     * @return void
     */
    public static function showThumbnail($post, $size=null) {
        $image = asset('img/noimage.webp');

        $path = $size ?  '/' . $size . '/' : '/';
        
        if ($post->post_image AND ImageHelper::isExists('images', $post->post_image) AND $size) {
            (new class { use PostTrait; })->generateAnotherSizePostThumbnailIfNotExists($post, $size);
        }

        if (!empty($post->post_image)) {
            if (ImageHelper::isExists('images' . $path, $post->post_image)) {
                $image = asset('storage/images'. $path . $post->post_image);
            } else {
                $image = asset('img/noimage.webp');
            }
        } else {
            $postImageMeta = self::isImageUrlAvailable($post);

            if ($postImageMeta) {
                $image = json_decode($post->post_image_meta)->image_url;
            } else {         
                preg_match_all('/src="([^"]*)"/', $post->post_content, $result);

                if (empty($result[1][0])) {
                    $image = asset('img/noimage.webp');
                } else {
                    if (filter_var($result[1][0], FILTER_VALIDATE_URL)) {
                        $image = $result[1][0];
                    } else {
                        if ($result[0]) {
                            if ((new class
                            {
                                use ImageTrait;
                            })->isExistFile('images', last(explode('/', $result[1][0])))) {
                                if (ImageHelper::isExists('images', last(explode('/', $result[1][0])))) {
                                    $image = asset('storage/images/' . last(explode('/', $result[1][0])));
                                }
                            }
                        }
                    }
                }
            }
        }
        return $image;
    }

    /**
     * Display Thumbnail For Single Post
     *
     * @param object $post
     * @return void
     */
    public static function displayThumbnailForSinglePost($post) {
        $image = asset('img/noimage.webp');

        if (!empty($post->post_image)) {
            if (ImageHelper::isExists('images/', $post->post_image)) {
                $image = asset('storage/images/' . $post->post_image);
            } else {
                $image = asset('img/noimage.webp');
            }
        } else {
            $postImageMeta = json_decode($post->post_image_meta)->image_url ? json_decode($post->post_image_meta)->image_url : null;

            if ($postImageMeta) {
                $image = json_decode($post->post_image_meta)->image_url;
            }
        }
        return $image;
    }

    /**
     * Check Image URL Available
     *
     * @param mixed $post
     * @return boolean
     */
    public static function isImageUrlAvailable($post) {
        if ($post->post_image_meta) {
            $decodedData = json_decode($post->post_image_meta);
            return (bool) $decodedData && isset($decodedData->image_url);
        }
    }

    /**
     * @param $post_image
     * @return string
     */
    public static function showPostThumbnail($postType, $post_image, $size=null)
    {
        if ($postType == 'audio') {
            $image = asset('img/cover-audio.webp');
        } else if ($postType == 'video') {
            $image = asset('img/cover-video.webp');
        }

        $size = $size ?  '/' . $size . '/' : '/';
        
        if (!empty($post_image) && ImageHelper::isExists('images' . $size, $post_image)) {
            $image = asset('storage/images'. $size . $post_image);
        }

        return $image;
    }

    /**
     * Get Post Thumbnail Url
     *
     * @param mixed $postImageMeta
     * @return void
     */
    public static function getPostThumbnailUrl($postImageMeta) 
    {
        return $postImageMeta ? json_decode($postImageMeta)->image_url : null;
    }

    /**
     * @param $request
     * @return string
     */
    public static function getPostThumbnailCaption($postImageMeta) 
    {
        return $postImageMeta ? json_decode($postImageMeta)->caption : null;
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
