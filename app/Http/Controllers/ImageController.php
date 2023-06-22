<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $image = new Image($request->all());
        $image->creator()->associate($user);
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
