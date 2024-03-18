<?php

namespace App\Traits;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

trait StorageDiskTrait
{
    /**
     * @return string
     */
    public function diskName()
    {
        return env('FILESYSTEM_DRIVER');
    }

    /**
     * @return Filesystem
     */
    public function diskStorage()
    {
        return Storage::disk($this->diskName());
    }


    /**
     * @param $dir
     * @return string
     */
    public function pathLocal($dir)
    {
        if (env('FILESYSTEM_DRIVER') == 'public_storage') {
            return public_path('storage/' . $dir);
        } else {
            return storage_path('app/public/' . $dir);
        }
    }

    /**
     * @param $dir
     * @param $file
     * @return bool
     */
    public function isExistFile($dir, $file)
    {
        return $this->diskStorage()->exists($dir . '/' . $file);
    }
}
