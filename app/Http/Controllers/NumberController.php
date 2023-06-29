<?php

namespace App\Http\Controllers;

use App\Models\Number;
use App\Http\Requests\Number\NumberStoreRequest;
use App\Http\Requests\Number\NumberUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $numbers = Number::all();
        return new JsonResponse($numbers, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NumberStoreRequest $request): JsonResponse
    {
        $number = new Number($request->all());
        $number->save();
        return new JsonResponse($number, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Number $number): JsonResponse
    {
        return new JsonResponse($number, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NumberUpdateRequest $request, Number $number): JsonResponse
    {
        $number->fill($request->all());
        $number->save();
        return new JsonResponse($number, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Number $number): JsonResponse
    {
        $number->delete();
        return new JsonResponse(null, 204);
    }
}
