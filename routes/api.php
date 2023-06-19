<?php

use App\Models\Enums\TelephoneNumberType;
use Illuminate\Http\Request;
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


Route::apiResource('addresses', \App\Http\Controllers\AddressController::class);
Route::apiResource('countries', \App\Http\Controllers\CountryController::class);
Route::apiResource('numbers', \App\Http\Controllers\NumberController::class);

Route::apiResource('users/{user}/numbers', \App\Http\Controllers\UserNumberController::class)->except(['show']);
Route::apiResource('users/{user}/addresses', \App\Http\Controllers\UserAddressController::class)->except(['show']);

Route::get('testuncio', function (Request $response) {
    return __('auth.failed');
    return __('telephone_number.type_' . TelephoneNumberType::DEFAULT);
});
