<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait ImageTrait
{
    use StorageDiskTrait;

    /**
     * @return string
     */
    public function pathImage()
    {
        return $this->pathLocal('images');
    }

    /**
     * @return string
     */
    public function pathAvatar()
    {
        return $this->pathLocal('avatar');
    }

    /**
     * @param $dir
     * @param $image
     * @return string
     */
    public function getBlobImage($dir, $image)
    {
        /** @var  object Storage*/
        $storage = $this->diskStorage();

        $file = $storage->get($dir . '/' . $image);
        $type = $storage->mimeType($dir . '/' . $image);

        return 'data:' . $type . ';base64,' . base64_encode($file);
    }

    /**
     * @param $fileName
     * @param $image
     * @return void
     */
    public function uploadFromBlobImage($fileName, $image)
    {
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);

        $fileImage = base64_decode($image);
        $path = $this->pathAvatar() . '/' . $fileName;

        if (!File::exists($this->pathAvatar())) {
            File::makeDirectory($this->pathAvatar());
        }

        file_put_contents($path, $fileImage);
    }
    
    /**
     * uploadFromBlobImageToS3
     *
     * @param  mixed $fileName
     * @param  mixed $image
     * @return void
     */
    public function uploadFromBlobImageToS3($fileName, $image)
    {
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);

        $fileImage = base64_decode($image);
        $path = $this->pathAvatar() . '/' . $fileName;

        if (!File::exists($this->pathAvatar())) {
            File::makeDirectory($this->pathAvatar());
        }

        file_put_contents($path, $fileImage);
    }
    
    /**
     * uploadFile
     *
     * @param  mixed $dir
     * @param  mixed $image
     * @return void
     */
    public function uploadFile($dir, $image)
    {
        $file = $image->getClientOriginalName();
        $name = pathinfo($file, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();

        $fileName = $name . '-' . time() . '.' . $extension;
        $image->storeAs($dir, $fileName, $this->diskName());

        return $fileName;
    }
    
    /**
     * uploadCategoryImage
     *
     * @param  mixed $requestImage
     * @return void
     */
    public function uploadCategoryImage($requestImage)
    {
        $file = $requestImage->getClientOriginalName();
        $name = pathinfo($file, PATHINFO_FILENAME);
        $extension = $requestImage->getClientOriginalExtension();

        $fileName = $name . '-' . time() . '.' . $extension;
        $requestImage->storeAs('images', $fileName, $this->diskName());

        return $fileName;
    }

    /**
     * @param $fileName
     * @return string
     */
    public function showAvatarInUploadContainer($fileName)
    {
        if ($fileName) {
            if ($this->isExistFile('avatar', $fileName)) {
                return $this->getBlobImage('avatar', $fileName);
            }
        }
        return 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D';
    }
    
    /**
     * showImage
     *
     * @param  mixed $dir
     * @param  mixed $fileName
     * @return void
     */
    public function showImage($dir, $fileName)
    {
        if ($fileName) {
            if ($this->isExistFile($dir, $fileName)) {
                return $this->getBlobImage($dir, $fileName);
            }
        }
        return 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D';
    }
    
    /**
     * storeAdScript
     *
     * @param  mixed $request
     * @return void
     */
    public function storeAdScript($request)
    {
        $this->diskStorage()
            ->put('ad/'.Str::slug($request->name).'-script.blade.php', $request->script_custom);
    }

    /**
     * @param $dir
     * @param $file
     * @return mixed
     */
    public function deleteImage($dir, $file)
    {
        return $this->diskStorage()->delete($dir . '/' . $file);
    }

    /**
     * @param $dir
     * @param $file
     * @return mixed
     */
    public function deleteFile($dir, $file)
    {
        return $this->diskStorage()->delete($dir . '/' . $file);
    }
}
