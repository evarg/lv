<?php

namespace App\Services;

use App\Models\File;
use App\Models\TelephoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function store(Request $request): File
    {
        $fileUpload = $request->file('file');
        $fileName = Storage::putFile('uploads', $fileUpload);

        $file = new File();
        $file->hash_name = $fileName;
        $file->name = $request->name;
        $file->orginal_name = $fileUpload->getClientOriginalName();
        $file->size = $fileUpload->getSize();
        $file->mime_type = $fileUpload->getClientMimeType();
        $file->creator()->associate(Auth::user());
        $file->save();

        return $file;
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
