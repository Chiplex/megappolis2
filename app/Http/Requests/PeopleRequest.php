<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'otherName' => 'required|max:50',
            'lastName' => 'required|max:50',
            'otherLastName' => 'max:50',
            'birth' => 'required|date',
            'country' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'sex' => 'required',
            'document' => 'required',
        ];
    }
}
