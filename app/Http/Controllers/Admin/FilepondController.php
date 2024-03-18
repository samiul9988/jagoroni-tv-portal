<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Support\Facades\Storage;
use Sopamo\LaravelFilepond\Http\Controllers\FilepondController as BaseFilepondController;

class FilepondController extends BaseFilepondController
{
    /**
     * @param string $id
     * @return Response
     */
    public function uploadRestore(string $id)
    {
        $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
        $disk = config('filepond.temporary_files_disk', 'local');

        $path = $filepond->getPathFromServerId($id);

        /** @var storage */
        $storage = Storage::disk($disk);

        $mime = $storage->mimeType($path);
        $file = $storage->get($path);

        return FacadeResponse::make($file, 200, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="'.basename($path).'"',
        ]);
    }
}
