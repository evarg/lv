<?php

namespace App\Http\Controllers;

use App\Http\Requests\Picture\PictureStoreRequest;
use App\Http\Requests\Picture\PictureUpdateRequest;
use App\Models\Picture;
use App\Services\PictureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Picture::all();
        $images->load('file.creator');
        return new JsonResponse($images);
    }

    /**
     * Display the specified resource.
     */
    public function show(Picture $image)
    {
        $image->load('file.creator');
        $image->load('thumbnails');
        return new JsonResponse($image, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PictureStoreRequest $request, PictureService $pictureService)
    {
        $pictureService->setRequest($request);
        $picture = $pictureService->storeOne($request);
        if (!$picture) {
            return new JsonResponse(['message' => $pictureService->getErrorMessage()], 500);
        }

        return $picture;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PictureUpdateRequest $request, Picture $image)
    {
        return new JsonResponse(['r' => $request]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Picture $image)
    {
        $image->delete();
        return new JsonResponse([], 204);
    }
}
