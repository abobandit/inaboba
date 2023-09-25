<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required',
            'visibility'=>'nullable',
            'image' =>[ 'nullable','image','mimes:png,jpeg,jpg' ]
        ];
    }
    public function messages()
    {
        return [
            'content.required' => 'content is required',
            'user_id.required' => 'user_id is required',
        ];
    }
}
