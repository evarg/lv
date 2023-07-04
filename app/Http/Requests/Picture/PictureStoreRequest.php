<?php

namespace App\Http\Requests\Picture;

use Illuminate\Foundation\Http\FormRequest;

class PictureStoreRequest extends FormRequest
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
            'picture' => 'required|image|mimes:png,jpg,jpeg|max:20480',
            'name' => 'max:255',
            'desc' => 'max:65535'
        ];
    }
}
