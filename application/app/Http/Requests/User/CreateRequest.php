<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name'=>'required',
            'password'=>'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/',
            'repeat_password'=>'required_with:password|same:password',
            'email'=>'required|regex:/^[a-z][a-z0-9_\.]{3,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/',
            'SDT'=>'required|regex:/^[0-9]*$/',
            'DiaChi'=>'required',
            'NgaySinh'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>"Bạn chưa nhập họ tên",
            'email.required'=>"Bạn chưa nhập email",
            'email.regex'=>"Định dạng email chưa đúng",
            'password.required'=>"Bạn chưa nhập password",
            'password.regex'=>"Định dạng mật khẩu chưa đúng",
            'SDT.required'=>"Bạn chưa nhập số điện thoại",
            'SDT.regex'=>"Định dạng số điện thoại chưa đúng",
            'DiaChi.required'=>"Bạn chưa nhập địa chỉ",
            'NgaySinh.required'=>"Vui lòng chọn ngày sinh"
        ];
    }
}
