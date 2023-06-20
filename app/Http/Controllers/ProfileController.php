<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user->load('addresses');
        $user->load('numbers');
        return new JsonResponse($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();
        return new JsonResponse($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $user->delete();
    }
}
