<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
        return [
            'country_id' => 'required|exists:\App\Models\Country,id',
            'city' => 'required|max:255',
            'street' => 'required|max:255',
            'zip_code' => 'required|max:255',
            'notes' => 'max:65535',
            'type' => 'numeric|min:0|max:255'
        ];
    }
}
