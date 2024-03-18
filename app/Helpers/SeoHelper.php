<?php

namespace App\Helpers;

use Artesaos\SEOTools\Facades\{OpenGraph, SEOTools};

Class SeoHelper
{    
    /**
     * getImage
     *
     * @return void
     */
    public static function getImage()
    {
        return (config('settings.og_image'))
            ? asset('storage/assets/' . config('settings.og_image'))
            : asset('img/cover.webp');
    }

    /**
     * getImagePage
     *
     * @param  mixed $page
     * @return void
     */
    public static function getImagePage($page)
    {
        return (config('settings.ogi_' . $page))
        ? asset('storage/assets/' . config('settings.ogi_' . $page))
        : asset('img/cover.webp');
    }

    /**
     * @param $title
     * @param $description
     * @param $keyword
     * @param $url
     * @return void
     */
    public static function getMeta($title = null, $description = null, $keyword = null, $url = null)
    {
        SEOTools::setTitle($title ?: config('settings.site_name'));
        SEOTools::setDescription($description ?: config('settings.site_description'));
        SEOTools::metatags()->setKeywords($keyword ?: config('settings.meta_keyword'));
        SEOTools::setCanonical($url?: config('settings.site_url'));
    }

    /**
     * @param $title
     * @param $description
     * @param $url
     * @param $siteName
     * @param $image
     * @return void
     */
    public static function getOpenGraph($title = null, $description = null, $url = null, $siteName = null, $image = null)
    {
        if (config('settings.fb_app_id')) {
            SEOTools::addMeta('fb:app_id', 'xxx', 'property');
        }

        SEOTools::opengraph()->setTitle($title ?: config('settings.site_name'));
        SEOTools::opengraph()->setDescription($description ?: config('settings.site_description'));
        SEOTools::opengraph()->setUrl($url ?: config('settings.site_url'));
        SEOTools::opengraph()->setSiteName($siteName ?:  config('settings.site_name'));
        SEOTools::opengraph()->addImage($image ?: self::getImage());
    }
    
    /**
     * getOpenGraphPage
     *
     * @param  mixed $page
     * @param  mixed $title
     * @param  mixed $description
     * @param  mixed $url
     * @param  mixed $siteName
     * @param  mixed $image
     * @return void
     */
    public static function getOpenGraphPage($page, $title = null, $description = null, $url = null, $siteName = null, $image = null)
    {
        if (config('settings.fb_app_id')) {
            SEOTools::addMeta('fb:app_id', 'xxx', 'property');
        }

        SEOTools::opengraph()->setTitle($title ?: config('settings.site_name'));
        SEOTools::opengraph()->setDescription($description ?: config('settings.site_description'));
        SEOTools::opengraph()->setUrl($url ?: config('settings.site_url'));
        SEOTools::opengraph()->setSiteName($siteName ?:  config('settings.site_name'));
        SEOTools::opengraph()->addImage($image ?: self::getImagePage($page));
    }

    /**
     * @param $title
     * @param $description
     * @param $url
     * @param $siteName
     * @param $image
     * @param $article
     * @return void
     */
    public static function getOpenGraphCustom(
        $title = null,
        $description = null,
        $url = null,
        $siteName = null,
        $image = null,
        $article = []
    )
    {
        OpenGraph::setTitle($title ?: config('settings.site_name'))
            ->setDescription($description)
            ->setType('article')
            ->setArticle($article);

        SEOTools::opengraph()->setDescription($description ?: config('settings.site_description'));
        SEOTools::opengraph()->setUrl($url ?: config('settings.site_url'));
        SEOTools::opengraph()->setSiteName($siteName ?:  config('settings.site_name'));
        SEOTools::opengraph()->addImage($image ?: self::getImage());
    }

    /**
     * @param $title
     * @param $description
     * @param $url
     * @param $image
     * @return void
     */
    public static function getTwitter($title = null, $description = null, $url = null, $image = null)
    {
        SEOTools::twitter()->setSite('@' . config('settings.twitter_username'));
        SEOTools::twitter()->setTitle($title ?: config('settings.site_name'));
        SEOTools::twitter()->setDescription($description ?: config('settings.site_description'));
        SEOTools::twitter()->setUrl($url ?: config('settings.site_url'));
        SEOTools::twitter()->setImage($image ?: self::getImage());
    }

    /**
     * @param $title
     * @param $description
     * @param $url
     * @param $image
     * @return void
     */
    public static function getJsonLd($title = null, $description = null, $url = null, $image = null)
    {
        SEOTools::jsonLd()->setTitle($title ?: config('settings.site_name'));
        SEOTools::jsonLd()->setDescription($description ?: config('settings.site_description'));
        SEOTools::jsonLd()->setType('WebPage');
        SEOTools::jsonLd()->setUrl($url ?: config('settings.site_url'));
        SEOTools::jsonLd()->addImage($image ?: self::getImage());
    }

    /**
     * @param $title
     * @param $description
     * @param $keyword
     * @param $siteName
     * @param $url
     * @return void
     */
    public static function getAll($title = null, $description = null, $keyword = null, $siteName = null, $url = null)
    {
        self::getMeta($title, $description, $keyword, $url);
        self::getOpenGraph($title, $description, $url, $siteName);

        if (config('settings.twitter_username')) {
            self::getTwitter($title, $description, $url);
        }

        self::getJsonLd($title, $description, $url);
    }
    
    
    /**
     * getAllPage
     *
     * @param  mixed $title
     * @param  mixed $description
     * @param  mixed $keyword
     * @param  mixed $siteName
     * @param  mixed $url
     * @return void
     */
    public static function getPage($page, $title = null, $description = null, $keyword = null, $siteName = null, $url = null)
    {
        self::getMeta($title, $description, $keyword, $url);
        self::getOpenGraphPage($page, $title, $description, $url, $siteName);

        if (config('settings.twitter_username')) {
            self::getTwitter($title, $description, $url);
        }

        self::getJsonLd($title, $description, $url);
    }
}
