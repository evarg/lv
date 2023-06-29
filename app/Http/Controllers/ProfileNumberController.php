<?php

namespace App\Http\Controllers;

//use App\Http\Requests\Number\NumberStoreRequest;
use App\Http\Requests\Number\NumberStoreRequest as RequestsNumberStoreRequest;
use App\Models\Number;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $numbers = $user->numbers;
        return new JsonResponse($numbers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsNumberStoreRequest $request)
    {
        $user = Auth::user();
        $number = new Number($request->all());
        $number->save();
        $user->numbers()->save($number);
        return new JsonResponse([$number], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Number $number)
    {
        $user = Auth::user();
        $user->numbers()->save($number);
        $number->save();
        return new JsonResponse($number, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Number $number)
    {
        $user = Auth::user();
        $user->numbers()->dissociate($number);
        $number->save();
        return new JsonResponse($number);
    }
}
