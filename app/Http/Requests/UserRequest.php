<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule as ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'login' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'first_name is required',
            'login.required' => 'login is required',
            'last_name.required' => 'last_name is required',
            'email.required' => 'email is required',
            'password.required' => 'password is required',
        ];
    }
}
