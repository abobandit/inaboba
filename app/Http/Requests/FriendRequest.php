<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FriendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'friend_id' => 'required',
            'user_id' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'friend_id' => 'friend id is required',
            'user_id' => 'user id is required'
        ];
    }
}
