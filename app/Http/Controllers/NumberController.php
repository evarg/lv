<?php

namespace App\Http\Controllers;

use App\Models\Number;
use App\Http\Requests\StoreNumberRequest;
use App\Http\Requests\UpdateNumberRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $numbers = Number::all();
<<<<<<< HEAD
        return new JsonResponse($numbers, 200);
=======
        return new JsonResponse($numbers);
>>>>>>> d0c2fa8 (crud cd)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNumberRequest $request)
    {
        $number = new Number($request->all());
        $number->save();
<<<<<<< HEAD

=======
>>>>>>> d0c2fa8 (crud cd)
        return new JsonResponse($number);
    }

    /**
     * Display the specified resource.
     */
    public function show(Number $number)
    {
<<<<<<< HEAD
        $number->load('user');
=======
>>>>>>> d0c2fa8 (crud cd)
        return new JsonResponse($number);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNumberRequest $request, Number $number)
    {
        $number->fill($request->all());
        $number->save();
        return new JsonResponse($number);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Number $number)
    {
        $number->delete();
<<<<<<< HEAD
        return new JsonResponse('Pomysnie usunieto');
=======
>>>>>>> d0c2fa8 (crud cd)
    }
}
