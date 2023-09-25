<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => 'required',
            'user_id' => 'required',
            'text' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'post_id.required' => 'post_id is required',
            'user_id.required' => 'user_id is required',
            'text.required' => 'text is required'
        ];
    }
}
