<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPaymentMethodRequest extends FormRequest
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
        $rule2 = request()->payment_method_id == '1' ? 'required|string' : 'required|string|digits_between:9,18';
        return [
            "account_label" =>  "required|string",
            "account_number" =>  $rule2,
            "bank_name" =>  'sometimes|string',
            "ifs_code" =>  'sometimes|string',
            "type" =>  'sometimes|string',
            "payment_method_id" =>  'required|string'
        ];
    }
}
