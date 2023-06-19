<?php

namespace App\Services;

use App\Models\TelephoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TelephoneNumberService
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function store(Request $request): TelephoneNumber
    {
        $telephoneNumber = new TelephoneNumber($request->all());
        $telephoneNumber->save();
        return $telephoneNumber;
    }

    public function delete(TelephoneNumber $telephoneNumber)
    {
        $telephoneNumber->delete();
    }
}
