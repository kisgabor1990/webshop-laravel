<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBillingAddressRequest extends FormRequest
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
    public function rules(AddressRequest $request)
    {
        return [
            'choose_company' => 'required|in:is_company,is_person',
            'name' => 'required|string',
            'taxnum' => (request()->choose_company == "is_company" ? 'required|regex:/\d{8}-[1-5]-\d{2}/' : ''),
        ];
    }
}
