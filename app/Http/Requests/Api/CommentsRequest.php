<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentsRequest extends FormRequest
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
            'parent_id' => 'in:comments.id',
            'title' => 'string|max:100',
            'content' => 'required|string|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'goods_id.in' => '所评论的商品不存在',
            'parent_id.in' => '所评论的评论不存在',
            'title.max' => '评论标题最多100个字符',
            'content.max' => '评论内容最多1024个字符',
            'content.required' => '请输入评论内容'
        ];
    }
}
