<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 'min:3','regex:/^([^0-9]*)$/'
            ],
            'last_name' => [
                'required', 'min:3','alpha'
            ],
            'email' => [
                'required', 'email', $this->isMethod('put')?Rule::unique('users','email')
                ->ignore($this->input('id'))->where('deleted_at',NULL)->where('role_id', $this->input('role')):
                Rule::unique('users','email')->where('role_id', $this->input('role'))->where('deleted_at',NULL),
            ],
            
            'password' => [
                $this->route()->user ? 'nullable' : 'required', 'confirmed', 'min:6'
            ],
            'phone'=>['required','digits:10',$this->isMethod('put')?Rule::unique('users','phone')
                ->ignore($this->input('id'))->where('deleted_at',NULL)->where('role_id', $this->input('role')):
                Rule::unique('users','phone')->where('role_id', $this->input('role'))->where('deleted_at',NULL)
            ],
            'role'=>'exists:roles,id|required',
            
        ];
    }
}
