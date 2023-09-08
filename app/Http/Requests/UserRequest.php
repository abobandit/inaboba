<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name'  => 'required',
            'login' => 'required',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required',
            'role' => 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'first_name.required'       => 'first_name is required',
            'login.required'       => 'login is required',
            'last_name.required'       => 'last_name is required',
            'email.required'    => 'email is required',
            'password.required' => 'password is required',
        ];
    }
}
