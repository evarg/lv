<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\AddressStoreRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $user = Auth::user();
        $addressess = $user->addresses;
        return new JsonResponse($addressess, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressStoreRequest $request)
    {
        $user = Auth::user();
        $address = new Address($request->all());
        $address->save();
        $address->users()->attach($user);

        return new JsonResponse($address, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $user = Auth::user();
        $user->addresses()->syncWithoutDetaching($address);
        return new JsonResponse([], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $user = Auth::user();
        $user->addresses()->detach($address);
        return new JsonResponse([], 204);
    }
}
