<?php

use App\Models\Enums\TelephoneNumberType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);


Route::middleware('auth:api')->group(function(){
    Route::delete('/auth', [\App\Http\Controllers\AuthController::class, 'destroy'])->name('logout')->middleware('auth:api');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::apiResource('addresses', \App\Http\Controllers\AddressController::class);
    Route::apiResource('countries', \App\Http\Controllers\CountryController::class);
    Route::apiResource('numbers', \App\Http\Controllers\NumberController::class);
    Route::apiResource('producers', \App\Http\Controllers\ProducerController::class);
    
    Route::apiResource('users', \App\Http\Controllers\UserController::class);
    Route::apiResource('users/{user}/numbers', \App\Http\Controllers\UserNumberController::class)->except(['show']);
    Route::apiResource('users/{user}/addresses', \App\Http\Controllers\UserAddressController::class)->except(['show']);
});

Route::apiResource('files', \App\Http\Controllers\FileController::class);

Route::post('/auth', [\App\Http\Controllers\AuthController::class, 'store'])->name('login');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'store'])->name('register.store');
Route::post('/forgot-password', [\App\Http\Controllers\RegisterController::class, 'index'])->name('forgot-password');

Route::get('testuncio', function (Request $response) {
    return Auth::user();
})->middleware('auth:api');;
