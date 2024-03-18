<?php

namespace App\Services;

use App\Models\{Setting};
use App\Traits\SettingTrait;

Class SettingService
{
    use SettingTrait;

    protected $setting, $language;
    
    /**
     * __construct
     *
     * @param  mixed $setting
     * @return void
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
    
    /**
     * openGraphUpdate
     *
     * @param  mixed $file
     * @param  mixed $page
     * @return void
     */
    public function openGraphUpdate($file, $page)
    {
        $filename = $file->hashName();

        $file->storeAs(
            'assets',
            $filename,
            $this->diskName()
        );

        return $this->modify('ogi_' . $page, $filename);
    }
    
    /**
     * modify
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public function modify($key, $value)
    {
        return $this->setting->where('key', $key)->update(['value' => $value]);
    }
}