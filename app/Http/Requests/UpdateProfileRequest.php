<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> 95a793d183348e27f07c0036792bde66533b9378

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
<<<<<<< HEAD
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id
=======
        $user = Auth::user();
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id
>>>>>>> 95a793d183348e27f07c0036792bde66533b9378
        ];
    }
}
