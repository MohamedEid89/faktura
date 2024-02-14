<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'nullable',
            'name' => 'required|string|max:255',
            'number' => 'nullable|string|unique|max:255',
            'mobile' => 'nullable|string|unique|max:255',
            'fax' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique|max:255',
            'address' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'stats' => 'nullable|string|max:255',
            'logo' => 'image|nullable',
            'organisations_nr' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
            'subscribe_code' => 'nullable|unique|string|max:255',
            'package' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'status' => 'nullable',
        ];
    }
}