<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email'       => 'required|email|unique:users,email,' . auth()->user()->id,
            'description' => 'string|nullable|max:1500',
            'politics'    => 'string|nullable|max:1500',
            'img'         => 'dimensions:width=200,height=200',
            'interests'   => 'string|nullable|max:1500',
            //
        ];
    }
}
