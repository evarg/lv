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
        $fileName = Str::uuid() . "." . $fileUpload->extension();
        $filePath = $fileUpload->storeAs('uploads', $fileName, 'public');

        $file = new File();
        $file->name = $request->name;
        $file->orginal_name = time() . '_' . $fileUpload->getClientOriginalName();
        $file->size = $fileUpload->getSize();
        $file->mime_type = $fileUpload->getClientMimeType();
        $file->hash_name = '/storage/' . $filePath;
        $file->creator()->associate(Auth::user());
        $file->save();

        return $file;
    }

    public function delete(File $file)
    {
        $file->delete();
    }
}
