<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Requests\File\FileStoreRequest;
use App\Http\Requests\File\FileUpdateRequest;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::all();
        return new JsonResponse($files);
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        $file->load('creator');
        return new JsonResponse($file);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileStoreRequest $request, FileService $fileService)
    {
        $file = $fileService->store($request);
        return new JsonResponse($file, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FileUpdateRequest $request, File $file, FileService $fileService): JsonResponse
    {
        $file = $fileService->update($file, $request);
        return new JsonResponse($file);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file, FileService $fileService)
    {
        $fileService->delete($file);
        Storage::delete($file->hash_name);
        return new JsonResponse([], 204);
    }
}
