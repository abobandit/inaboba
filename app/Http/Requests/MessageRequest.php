<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_chat_id' => 'required',
            'text' => 'required',
        ];
    }
    public function messages():array
    {
        return [
            'user_chat_id.required' => 'user_chat_id is required',
            'text.required' => 'text is required',
        ];
    }
}
