<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        $fileModel = new File;
        $file = $request->file('file');
        if ($request->file()) {
            $fileName = Str::uuid() . "." . $file->extension();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = "rs";
            $fileModel->orginal_name = time() . '_' . $request->file->getClientOriginalName();
            $fileModel->size = $file->getSize();
            $fileModel->mime_type = $request->file->getClientMimeType();
            $fileModel->hash_name = '/storage/' . $filePath;
            $fileModel->creator_id = 1;
            $fileModel->save();
            return new JsonResponse($fileModel, 201);
        }

        $user = Auth::user();
        $file = new File($request->all());
        $file->creator()->associate($user);
        $file->save();
        return new JsonResponse($file, 201);
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
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        $file->fill($request->all());
        $file->save();
        return new JsonResponse($file);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $file->delete();
        return new JsonResponse(['message' => __('file.deleted')], 200);
    }
}
