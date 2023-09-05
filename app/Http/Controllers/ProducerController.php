<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $producers = Producer::all();
        return new JsonResponse($producers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProducerRequest $request)
    {
        $user = Auth::user();
        $producer = new Producer($request->all());
        $producer->creator()->associate($user);
        $producer->save();
        return new JsonResponse($producer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producer $producer)
    {
        $producer->load('creator');
        return new JsonResponse($producer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProducerRequest $request, Producer $producer)
    {
        $producer->fill($request->all());
        $producer->save();
        return new JsonResponse($producer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producer $producer)
    {
        $producer->delete();
        return new JsonResponse(['message' => __('producer.deleted')], 200);
    }
}
