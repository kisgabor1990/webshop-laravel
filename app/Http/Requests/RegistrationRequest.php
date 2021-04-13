<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'phone' => 'required|numeric',
            'aszf' => 'required',
            'choose_company' => 'required|in:is_company,is_person',
            'billing_name' => 'required|string',
            'billing_city' => 'required|string',
            'billing_address' => 'required|string',
            'billing_zip' => 'required|digits:4',
        ];
    }

}
