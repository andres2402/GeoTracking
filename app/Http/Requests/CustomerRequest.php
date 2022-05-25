<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'email'=>['required','email',
                Rule::unique('users','email')->where('role_id', 2)->where('deleted_at',NULL)],
            'phone'=>['required','digits:10',
                Rule::unique('users','phone')->where('role_id', 2)->where('deleted_at',NULL)
            ],
            'password'=>'required|confirmed|min:6',
            'state'=>'nullable|numeric',
        ];
    }
}
