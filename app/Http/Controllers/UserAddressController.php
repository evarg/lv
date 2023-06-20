<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $addressess = $user->addresses;
        return new JsonResponse($addressess);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request, User $user)
    {
        $address = new Address($request->all());
        $address->save();

        $address->users()->attach($user);
        return new JsonResponse($address, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, Address $address)
    {
        $address->users()->syncWithoutDetaching($user);
        return new JsonResponse($address, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Address $address)
    {
        $user->addresses()->detach($address);
        return new JsonResponse($user->addresses);
    }
}
