<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\Country\CountryStoreRequest;
use App\Http\Requests\Country\CountryUpdateRequest;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        return new JsonResponse($countries, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        $country->load('addresses');
        return new JsonResponse($country);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryStoreRequest $request)
    {
        $country = new Country($request->all());
        $country->save();
        return new JsonResponse($country, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryUpdateRequest $request, Country $country)
    {
        $country->fill($request->all());
        $country->save();
        return new JsonResponse($country, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete([], 204);
    }
}
