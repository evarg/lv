<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNumberRequest;
use App\Http\Requests\UpdateNumberRequest;
use App\Models\Number;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $numbers = $user->numbers;
        return new JsonResponse($numbers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNumberRequest $request, User $user)
    {
        $number = new Number($request->all());
        $number->user()->associate($user);
        $number->save();
        return new JsonResponse($number, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, Number $number)
    {
        $number->user()->associate($user);
        $number->save();
        return new JsonResponse($number, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Number $number)
    {
        $number->user()->dissociate($number);
        $number->save();
        return new JsonResponse($number);
    }
}
