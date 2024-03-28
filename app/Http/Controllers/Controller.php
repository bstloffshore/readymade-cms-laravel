<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Psr\Log\LoggerInterface;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function log()
    {
        return app(LoggerInterface::class);
    }


    public function uploadImage($requestImage,$thumbnailPath,$mediumPath,$largePath)
    {

            $image = time() . '.' . $requestImage->getClientOriginalExtension();
            if (!Storage::exists($thumbnailPath)) {
                Storage::makeDirectory($thumbnailPath);
            }
            if (!Storage::exists($mediumPath)) {
                Storage::makeDirectory($mediumPath);
            }
            if (!Storage::exists($largePath)) {
                Storage::makeDirectory($largePath);
            }
            // Create a thumbnail
            $thumbnail = Image::make($requestImage->path());
            $thumbnail->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Create a medium-sized image
            $medium = Image::make($requestImage->path());
            $medium->resize(300,300, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($thumbnailPath . $image, $thumbnail->stream());
            Storage::put($mediumPath . $image, $medium->stream());
            Storage::putFileAs($largePath, $requestImage, $image);
            //$requestData['image'] = $image;
            return $image;

    }
}
