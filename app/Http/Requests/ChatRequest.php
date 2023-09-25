<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable',
            'users' => 'required',
            'isPrivate' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'title is required',
            'users.required' => 'users is required',
        ];
    }
}
