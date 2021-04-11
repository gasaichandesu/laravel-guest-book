<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attachment' => [
                'required',
                'image',
                'max: 100',
                'dimensions:min_width=100,min_height=100'
            ],
            'text' => [
                'required',
                'max:1000'
            ]
        ];
    }
}
