<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MalfunctionStatusChangeRequest extends FormRequest
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
            'status' => 'required|in_array:pending,in progress,fixed',
            'report' => 'required|string|max:2000',
        ];
    }
}
