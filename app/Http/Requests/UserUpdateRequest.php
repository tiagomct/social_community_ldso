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
        return[
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'description' => 'string|max:1500',
            'politics' => 'string|max:300',
            'img' =>  'dimensions:width=200,height=200',
            'interests' => 'string|max:255',
            //
        ];
    }
}
