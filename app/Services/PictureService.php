<?php

namespace App\Services;

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

        Storage::copy($fileName, 'images/' . $pictureName . '_org.' . $fileUpload->getClientOriginalExtension());

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


        $image = ImageManager::make(Storage::disk('local')->path($fileName));

        // 1600x1200
        $destinationName = 'images/' . $pictureName . '_rx.' . $fileUpload->getClientOriginalExtension();
        $image->resize(1600, 1200, function ($constraint) {
            //$constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->save(Storage::disk('local')->path($destinationName));

        $destinationName = 'images/' . $pictureName . '_sx.' . $fileUpload->getClientOriginalExtension();
        $image->resizeCanvas(1200, 1200, 'center');
        $image->save(Storage::disk('local')->path($destinationName));

        // 800x600
        $destinationName = 'images/' . $pictureName . '_rl.' . $fileUpload->getClientOriginalExtension();
        $image->resize(800, 600);
        $image->save(Storage::disk('local')->path($destinationName));
        $destinationName = 'images/' . $pictureName . '_sl.' . $fileUpload->getClientOriginalExtension();
        $image->resizeCanvas(600, 600, 'center');
        $image->save(Storage::disk('local')->path($destinationName));

        //400x300
        $destinationName = 'images/' . $pictureName . '_rm.' . $fileUpload->getClientOriginalExtension();
        $image->resize(400, 300);
        $image->save(Storage::disk('local')->path($destinationName));
        $destinationName = 'images/' . $pictureName . '_sm.' . $fileUpload->getClientOriginalExtension();
        $image->resizeCanvas(300, 300, 'center');
        $image->save(Storage::disk('local')->path($destinationName));

        //200x150
        $destinationName = 'images/' . $pictureName . '_rs.' . $fileUpload->getClientOriginalExtension();
        $image->resize(200, 150);
        $image->save(Storage::disk('local')->path($destinationName));
        $destinationName = 'images/' . $pictureName . '_ss.' . $fileUpload->getClientOriginalExtension();
        $image->resizeCanvas(150, 150, 'center');
        $image->save(Storage::disk('local')->path($destinationName));

        return $picture;
    }

    public function update(File $file, Request $request): File
    {
        $file->fill($request->all());
        $fileUpload = $request->file('file');
        if($fileUpload){
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
