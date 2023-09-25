<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'path' => 'required',
            'folder' => 'required',
            'description' => 'nullable',
            'album_id' => 'required',
            'title'=>'required'
        ];
    }
    public function messages():array
    {
        return [
            'path.required' => 'path is required',
            'folder.required' => 'path is required',
            'album_id.required' => 'album_id is required',
            'title.required' => 'title is required',
        ];
    }
}
