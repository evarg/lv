<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\File;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::all();
        return new JsonResponse($images);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $fileUpload = $request->file('file');

        $file = new File();
        $fileName = Str::uuid() . "." . $fileUpload->extension();
        $filePath = $fileUpload->storeAs('uploads', $fileName, 'public');
        $file->name = "";
        $file->orginal_name = time() . '_' . $fileUpload->getClientOriginalName();
        $file->size = $fileUpload->getSize();
        $file->mime_type = $fileUpload->getClientMimeType();
        $file->hash_name = '/storage/' . $filePath;
        $file->creator()->associate(Auth::user());
        $file->save();

        $image = new Image();
        $image->file()->associate($file);
        $image->save();

        return new JsonResponse($image, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image->load('creator');
        return new JsonResponse($image);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $image->fill($request->all());
        $image->save();
        return new JsonResponse($image);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return new JsonResponse(['message' => __('image.deleted')], 200);
    }
}
