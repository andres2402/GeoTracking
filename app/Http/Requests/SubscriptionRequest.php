<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            //
			'name' => [ 'required', 'min:3','regex:/^([^0-9]*)$/'],
			'description' => [ 'required', 'min:3'],
			'image_filename' => [ 'required','image','mimes:jpeg,png,jpg,gif,svg','max:2048' ],
			'limit_offered_services' => ['required', 'min:1'],
			'limit_accepted_services' => ['required', 'min:1'],
			'limit_monthly_promos' => ['required', 'min:1'],
			'limit_shared_images' => ['required', 'min:1'],
			'limit_profile_updates' => ['required', 'min:1'],
			'location' => ['required']
        ];
    }
}
