<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
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
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        $address = new Address($request->all());
        $address->save();
        return new JsonResponse($address);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        $address->load('country');
        return new JsonResponse($address);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->fill($request->all());
        $address->save();
        return new JsonResponse($address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return new JsonResponse(['message' => __('address.deleted')], 200);
    }
}
