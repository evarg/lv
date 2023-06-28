<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\AddressStoreRequest;
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
        return new JsonResponse($addressess, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressStoreRequest $request, User $user)
    {
        $address = new Address($request->all());
        $address->save();
        $address->users()->attach($user);

        return new JsonResponse([], 204);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, Address $address)
    {
        $address->users()->syncWithoutDetaching($user);
        return new JsonResponse([], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Address $address)
    {
        $user->addresses()->detach($address);
        return new JsonResponse([], 204);
    }
}
