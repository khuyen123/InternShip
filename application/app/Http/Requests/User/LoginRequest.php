<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'=>'required|regex:/^[a-z][a-z0-9_\.]{3,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/',
            'password'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'email.required'=>"Vui lòng nhập email",
            'email.regex'=>"Định dạng email chưa đúng",
            'password.required'=>"Bạn chưa nhập password"
        ];
    }
}
