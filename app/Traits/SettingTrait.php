<?php

namespace App\Traits;

trait SettingTrait
{
    use ImageTrait;
        
    /**
     * getAssetImage
     *
     * @param  mixed $filename
     * @return void
     */
    public function getAssetImage($filename)
    {
        return $filename ? $this->getBlobImage('assets', $filename) : null;
    }
    
    /**
     * getCount
     *
     * @param  mixed $model
     * @return void
     */
    public function getCount($model)
    {
        return $model->count();
    }
}
