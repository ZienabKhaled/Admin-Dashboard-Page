<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255', // Name is required and should be a string with a maximum of 255 characters.
            'description' => 'required|string', // Description is required and should be a string.
            'price' => 'required|string', // Price is required and should be a numeric value.
            'color' => 'nullable|string|size:7', // Color should be a string of exactly 7 characters or can be nullable.
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Image s
        ];
    }
}
