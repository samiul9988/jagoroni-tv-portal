<?php

namespace App\Services;

use App\Helpers\LocalizationHelper;
use App\Models\{Language, User};
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\{Auth, File};

Class LanguageService
{
    protected $language;
    
    /**
     * __construct
     *
     * @param  mixed $language
     * @return void
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
    }
    
    /**
     * getLanguageCodeById
     *
     * @param  mixed $id
     * @return void
     */
    public function getLanguageCodeById($id)
    {
        return Language::find($id);
    }
    
    /**
     * getLanguageNameByAuth
     *
     * @return void
     */
    public function getLanguageNameByAuth()
    {
        $languageId = Auth::user()->language;
        $language = Language::find($languageId);
        return $language->name;
    }
    
    /**
     * getLanguageCodeByAuth
     *
     * @return void
     */
    public function getLanguageCodeByAuth()
    {
        $languageId = Auth::user()->language;
        $language = Language::find($languageId);
        return $language->language;
    }
    
    /**
     * activeCount
     *
     * @return void
     */
    public function activeCount()
    {
        return Language::query()->active()->count();
    }
    
    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $check_language = Language::where('language', request('language'))
            ->where('country_code', request('country'))
            ->exists();

        if ($check_language) {
            return response()->json(['error_exists' => __('message.name_exists')]);
        }

        $locales = json_decode(file_get_contents(storage_path('app/public/file/locales.json')), true);

        $countries = LocalizationHelper::countries();

        function filter_array($array, $key, $term)
        {
            $matches = array();
            foreach ($array as $a) {
                if ($a[$key] == $term) {
                    $matches[] = $a;
                }
            }
            return $matches;
        }

        $arr_country = filter_array($countries, 'code', request('country'));

        Language::create([
            'name'         => data_get($locales, request('language') . '.name'),
            'language'     => request('language'),
            'country'      => data_get(Arr::collapse($arr_country), 'name'),
            'country_code' => request('country'),
            'direction'    => data_get($locales, request('language') . '.direction')
        ]);

        $path = base_path('lang') . '/' . request('language');
        $path_adminlte = base_path('lang/vendor/adminlte') . '/' . request('language');
        $path_env_editor = base_path('lang/vendor/env-editor') . '/' . request('language');
        $path_share = base_path('lang/vendor/laravel-share') . '/' . request('language');
        $path_theme = base_path('lang/vendor/theme') . '/' . request('language');
        $path_tranlation = base_path('lang/vendor/translation') . '/' . request('language');
       
        // File::makeDirectory($path, $mode = 0777, true, true);
        // File::makeDirectory($path_adminlte, $mode = 0777, true, true);
        // File::makeDirectory($path_env_editor, $mode = 0777, true, true);
        // File::makeDirectory($path_theme, $mode = 0777, true, true);
        // File::makeDirectory($path_tranlation, $mode = 0777, true, true);

        File::copy(base_path('lang/en.json'), base_path('lang/'.request('language').'.json'));

        if(!File::isDirectory($path)){
            File::copyDirectory(base_path('lang/en'), $path);
        }

        //vendor adminlte
        if(!File::isDirectory($path_adminlte)){
            File::copyDirectory(base_path('lang/vendor/adminlte/en'), $path_adminlte);
        }

        //vendor env-editor
        if(!File::isDirectory($path_env_editor)){
            File::copyDirectory(base_path('lang/vendor/env-editor/en'), $path_env_editor);
        }

        //vendor laravel-share
        if(!File::isDirectory($path_share)){
            File::copyDirectory(base_path('lang/vendor/laravel-share/en'), $path_share);
        }

        //vendor theme
        if(!File::isDirectory($path_theme)){
            File::copyDirectory(base_path('lang/vendor/theme/en'), $path_theme);
        }

        //vendor translation
        if(!File::isDirectory($path_tranlation)){
            File::copyDirectory(base_path('lang/vendor/translation/en'), $path_tranlation);
        }

        $languages = Language::all();

        $dataArr = [];
        foreach ($languages as $language) {
            $dataArr[] = [
                $language->language => [
                    "name"     => data_get($locales, $language->language . '.name'),
                    "script"   => data_get($locales, $language->language . '.script'),
                    "native"   => data_get($locales, $language->language . '.native'),
                    "regional" => $language->language . '_' . $language->country_code,
                ]
            ];
        }

        $dataJson = json_encode(Arr::collapse($dataArr), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        File::put(storage_path('app/public/file/supportedLocales.json'), trim($dataJson, '[]'));
    }
    
    /**
     * modify
     *
     * @param  mixed $language
     * @return void
     */
    public function modify($language)
    {
        $data = json_decode(file_get_contents(storage_path('app/public/file/supportedLocales.json')), true);
        $data[$language->language]['name'] = request('language');
        $newJsonString = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);;
        File::put(storage_path('app/public/file/supportedLocales.json'), trim($newJsonString, '[]'));

        $language->name = request('language');
        $language->save();
    }
    
    /**
     * remove
     *
     * @param  mixed $language
     * @return void
     */
    public function remove($language)
    {
        $languageDefault = Language::select('id', 'language')
        ->firstWhere('language', config('settings.default_language'))
        ->language;
        $languageCode    = $language->language;

        if (Auth::user()->language == $language->id) {
            User::find(Auth::id())->update(['language' => $languageDefault]);
        }

        $getJson = json_decode(file_get_contents(storage_path('app/public/file/supportedLocales.json')), true);

        Arr::forget($getJson, $languageCode);

        $dataJson = json_encode($getJson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        File::put(storage_path('app/public/file/supportedLocales.json'), trim($dataJson, '[]'));

        return Language::find($language->id);
    }
    
    /**
     * massRemove
     *
     * @param  mixed $language
     * @return void
     */
    public function massRemove()
    {
        $userLanguageId = Auth::user()->language;
        $languageCodeDefault = Language::select('language')->firstWhere('language', config('settings.default_language'))->language;

        $getJson = json_decode(file_get_contents(storage_path('app/public/file/supportedLocales.json')), true);

        foreach (request('id') as $requestId) {
            $language = Language::find($requestId);

            if ($language->language === config('settings.default_language')) {
                $savedId[] = $language->id;
            } else {
                if ($userLanguageId == $requestId) {
                    User::find(Auth::id())->update(['language' => $languageCodeDefault]);
                }
                $languageCode = Language::find($requestId)->language;
                Arr::forget($getJson, $languageCode);
            }
        }

        $dataJson = json_encode($getJson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        File::put(storage_path('app/public/file/supportedLocales.json'), trim($dataJson, '[]'));

        if (!empty($savedId)) {
            $result = array_diff(request('id'), $savedId);
            $languages_id_array = Arr::flatten($result);
        } else {
            $languages_id_array = request('id');
        }

        return Language::whereIn('id', $languages_id_array);
    }
    
    /**
     * showDropdown
     *
     * @return void
     */
    public static function showDropdown()
    {
        return Language::query()->active()->get();
    }
    
    /**
     * listFlags
     *
     * @return void
     */
    public static function listFlags()
    {
        return Language::select('id', 'language', 'country_code')->active()->get();
    }
}
