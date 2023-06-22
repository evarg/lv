<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> 95a793d183348e27f07c0036792bde66533b9378

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
<<<<<<< HEAD
=======
        $user = Auth::user();
>>>>>>> 95a793d183348e27f07c0036792bde66533b9378
        $user->load('addresses');
        $user->load('numbers');
        return new JsonResponse($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
<<<<<<< HEAD
=======
        $user = Auth::user();
>>>>>>> 95a793d183348e27f07c0036792bde66533b9378
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();
        return new JsonResponse($user);
    }

    /**
     * Remove the specified resource from storage.
     */
<<<<<<< HEAD
    public function destroy()
    {
        $user->delete();
=======
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
>>>>>>> 95a793d183348e27f07c0036792bde66533b9378
    }
}
