<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
        switch ($this->route()->getActionMethod()) {
            case 'update':
                return [
                    'name' => 'required|max:16',
                    'sex' => 'required|between:1,2',
                    'tel' => 'required|max:16',
                    'address' => 'required|max:255',
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'name.required' => '请输入姓名',
            'name.max' => '姓名不可以超过16个字符',
            'sex.required' => '请选择性别',
            'sex.max' => '性别格式有误',
            'tel.required' => '请输入手机号',
            'tel.max' => '手机号过长',
            'address.required' => '请输入地址',
            'address.max' => '地址最多255个字符',
        ];
    }
}
