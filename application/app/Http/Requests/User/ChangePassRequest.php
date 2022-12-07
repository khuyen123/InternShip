<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassRequest extends FormRequest
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
            'new_pass'=>'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/',
            'repeat_pass'=>'required_with:new_pass|same:new_pass'
        ];
    }
    public function messages()
    {
        return [
           'new_pass.required'=>"Bạn chưa nhập mật khẩu mới",
           'new_pass.regex'=>"Định dạng mật khẩu mới chưa đúng",
           'repeat_pass.same' => "Mật khẩu nhập lại không đúng"

        ];
    }
}
