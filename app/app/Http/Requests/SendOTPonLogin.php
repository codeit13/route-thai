<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendOTPonLogin extends FormRequest
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
            'email' => ['required', 'string', 'email', 'exists:users,email'],
        ];
    }
    public function messages(){
        return [
            "email.exists" =>'The entered email is not registered with us. Please check once'
        ];
    }
}
