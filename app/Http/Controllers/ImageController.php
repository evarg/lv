<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\ImageStoreRequest;
use App\Http\Requests\Image\ImageUpdateRequest;
use App\Models\File;
use App\Models\Image;
use App\Services\FileService;
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
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image->load('creator');
        return new JsonResponse($image, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageStoreRequest $request, FileService $fileService)
    {
        $file = $fileService->store($request);

        $image = new Image();
        $image->file()->associate($file);
        $image->save();

        return new JsonResponse($image, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageUpdateRequest $request, Image $image)
    {
        return new JsonResponse(['r' => $request]);
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
