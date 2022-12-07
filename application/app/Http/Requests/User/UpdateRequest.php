<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'SDT'=>'required|regex:/^[0-9]*$/',
            'DiaChi'=>'required',
            'NgaySinh'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>"Bạn chưa nhập họ tên",
            'SDT.required'=>"Bạn chưa nhập số điện thoại",
            'SDT.regex'=>"Định dạng số điện thoại chưa đúng",
            'DiaChi.required'=>"Bạn chưa nhập địa chỉ",
            'NgaySinh.required'=>"Vui lòng chọn ngày sinh"
        ];
    }
}
