<?php

namespace App\Services;

use App\Models\Enums\PictureSize;
use App\Models\File;
use App\Models\Picture;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as ImageManager;

class PictureService
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function createAndStoreThumbnails()
    {
        foreach (config('packet.thumbs') as $thumbConfig) {
            var_dump($thumbConfig);
        }
    }

    public function store(Request $request): Picture
    {
        $fileUpload = $request->file('picture');
        $fileName = Storage::putFile('uploads', $fileUpload);

        $pictureName = Str::uuid();

        $image = ImageManager::make(Storage::disk('local')->path($fileName));
        $picture = new Picture($request->all());
        $picture->size = $fileUpload->getSize();
        $picture->orginal_name = $fileUpload->getClientOriginalName();
        $picture->hash_name = $pictureName;
        $picture->mime_type = $fileUpload->getClientMimeType();
        $picture->width = $image->height();
        $picture->height = $image->width();
        $picture->creator()->associate(Auth::user());
        $picture->save();

        var_dump($fileName);
        var_dump($picture->getFileNameBySizeEnum());

        //Debugbar::error('Error!');

        Storage::move($fileName, $picture->getFileNameBySizeEnum());

        $image = ImageManager::make(Storage::disk('local')->path($fileName));

        foreach (config('packet.thumbs') as $thumbConfig) {
            $thumb = new Thumbnail(
                $image,
                $thumbConfig['width'],
                $thumbConfig['height'],
                $picture->getFileNameBySuffix($thumbConfig['suffix']),
                $thumbConfig['crop']
            );
            $thumb->save();
        }
        return $picture;
    }

    public function createAndStoreThumbnail(int $width, int $height, bool $ratio, string $fileName)
    {
    }

    public function update(File $file, Request $request): File
    {
        $file->fill($request->all());
        $fileUpload = $request->file('file');
        if ($fileUpload) {
            if (Storage::exists($file->hash_name)) {
                Storage::delete($file->hash_name);
            }
            $fileName = Storage::putFile('uploads', $fileUpload);
            $file->hash_name = $fileName;
            $file->orginal_name = $fileUpload->getClientOriginalName();
            $file->size = $fileUpload->getSize();
            $file->mime_type = $fileUpload->getClientMimeType();
        }
        $file->save();
        return $file;
    }

    public function delete(File $file)
    {
        if (Storage::exists($file->hash_name)) {
            Storage::delete($file->hash_name);
        }
        $file->delete();
    }
}
