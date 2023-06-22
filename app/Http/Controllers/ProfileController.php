<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        $user->load('addresses');
        $user->load('numbers');
        return new JsonResponse($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();
        return new JsonResponse($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

return auth()->check($data);

        if (!auth()->check($data)) {
            return new JsonResponse(['error_message' => 'Incorrect Details. Please try again']);
        }

        $user = Auth::user();
        //$user->delete();
        return new JsonResponse(['error_message' => 'Konto zostało usunięte.']);
    }
}
