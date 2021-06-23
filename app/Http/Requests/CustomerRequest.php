<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            'aszf' => 'required',
            'choose_company' => 'required|in:is_company,is_person',
            'billing_name' => 'required|string',
            'billing_city' => 'required|string',
            'billing_address' => 'required|string',
            'billing_zip' => 'required|digits:4',
            'taxnum' => (request()->choose_company == "is_company" ? 'required|regex:/\d{8}-[1-5]-\d{2}/' : ''),
            'shipping_name' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_address' => 'required|string',
            'shipping_zip' => 'required|digits:4',
        ];
    }
}
