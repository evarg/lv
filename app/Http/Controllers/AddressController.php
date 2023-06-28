<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Requests\Address\AddressStoreRequest;
use App\Http\Requests\Address\AddressUpdateRequest;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::all();
        return new JsonResponse($addresses);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        $address->load('country');
        return new JsonResponse($address, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressStoreRequest $request)
    {
        $address = new Address($request->all());
        $address->save();
        return new JsonResponse($address, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressUpdateRequest $request, Address $address)
    {
        $address->fill($request->all());
        $address->save();
        return new JsonResponse($address, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return new JsonResponse([], 200);
    }
}
