<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReferendumRequest extends FormRequest
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
            'title' => 'string|required|max:255',
            'description' => 'string|required|max:1500',
            'answers.*' => 'string|required|max:1500',
        ];
    }
}
