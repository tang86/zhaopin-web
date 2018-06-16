<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Good;
use App\User;

class OrdersRequest extends FormRequest
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
            'goods_id' => 'in:goods.id',
            'user_id' => 'in:users.id',
            'price_level' => 'required|numeric',
            'price' => 'required|numeric',
            'paid_price' => 'required|numeric',
            'coupon_price' => 'numeric'
        ];
    }

    public function messages()
    {
        return [
            'price_level.required' => '缺少参数，"price_level"',
            'price.required' => '价格不能为空',
            'paid_price.required' => '实付价格不能为空',
            'price.numeric' => '价格必须为数字',
            'paid_price.numeric' => '实付价格必须为数字',
            'coupon_price.numeric' => '优惠卷价格必须为数字'
        ];
    }
}
