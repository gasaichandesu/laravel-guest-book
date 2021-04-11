<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

use Image as ImageFacade;
use Intervention\Image\Image;
use Storage;

class UploadsService
{
    public function storeImage(UploadedFile $file, string $fileName): void
    {
        $image = ImageFacade::make($file->path());

        if ($image->height() > 500) {
            $image->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        if ($image->width() > 500) {
            $image->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $image->save(storage_path('app/public') . "/$fileName");
    }

    public function deleteImage(string $fileName): void
    {
        Storage::delete($fileName);
    }
}