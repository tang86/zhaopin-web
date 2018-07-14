<?php

namespace App\Http\Requests\Api;

use App\Models\Good;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponsRequest extends FormRequest
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
            'goods_id' => Rule::in(Good::fluck('id')->toArray())
        ];
    }
}
