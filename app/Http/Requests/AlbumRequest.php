<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
//            'user_id' => 'required',
                'title' => 'nullable'
        ];
    }

    public function messages(): array
    {
        return [
//            'user_id.required' => 'user_id is required'
        ];
    }
}
