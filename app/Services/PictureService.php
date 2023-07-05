<?php

namespace App\Services;

use App\Models\Enums\PictureSize;
use App\Models\File;
use App\Models\Picture;
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

        Storage::move($fileName, $picture->getFileName());

        $image = ImageManager::make(Storage::disk('local')->path($fileName));

        $image->resize(1600, 1200, function ($constraint) {
            $constraint->upsize();
        });
        $image->save($picture->getFileName(PictureSize::SIZE_RX));
        $image->resizeCanvas(1200, 1200, 'center');
        $image->save($picture->getFileName(PictureSize::SIZE_SX));

        $image->resize(800, 600);
        $image->save($picture->getFileName(PictureSize::SIZE_RL));
        $image->resizeCanvas(600, 600, 'center');
        $image->save($picture->getFileName(PictureSize::SIZE_SL));

        $image->resize(400, 300);
        $image->save($picture->getFileName(PictureSize::SIZE_RM));
        $image->resizeCanvas(300, 300, 'center');
        $image->save($picture->getFileName(PictureSize::SIZE_SM));

        $image->resize(200, 150);
        $image->save($picture->getFileName(PictureSize::SIZE_RS));
        $image->resizeCanvas(150, 150, 'center');
        $image->save($picture->getFileName(PictureSize::SIZE_SS));

        return $picture;
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
