<?php

namespace App\Http\Controllers;

use App\Models\Number;
use App\Http\Requests\StoreNumberRequest;
use App\Http\Requests\UpdateNumberRequest;
use App\Models\User;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNumberRequest $request)
    {
//        $user = User::factory()->create();
        $number = new Number($request->all());
//        $telephoneNumber->user()->associate($user);
        $number->save();

        return Number::find($number);
    }

    /**
     * Display the specified resource.
     */
    public function show(Number $telephoneNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNumberRequest $request, Number $telephoneNumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Number $telephoneNumber)
    {
        //
    }
}
