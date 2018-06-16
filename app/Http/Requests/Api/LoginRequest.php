<?php

namespace App\Http\Requests\Api;

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
        if (!empty($this->js_code)) {
            $str = $this->getCurl('https://api.weixin.qq.com/sns/jscode2session?appid=' . config('services.media.app_id') . '&secret=' . config('services.media.secret') . '&js_code=' . $this->js_code . '&grant_type=authorization_code');
            if (empty($data = json_decode($str, true)) || !empty($data['errcode'])) return false;
            $this->open_id = $data['openid'];
            $this->session_key = $data['session_key'];
            $this->union_id = $data['unionid']??null;
            return true;
        }

        return true;
    }

    public function messages()
    {
        return [
            'js_code.required' => '请输入用户授权js_code',
            'head_url.url' => '用户头像必须是正确url格式地址',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getActionMethod()) {
            case 'login':
                return [
                    'js_code' => 'required|string',
                    'head_url' => 'nullable|url',
                    'name' => 'nullable|string|max:255',
                ];
        }
    }


    /**
     * 说明: get请求指定curl
     *
     * @param $url
     * @return mixed
     * @author 郭庆
     */
    private function getCurl($url)
    {
        $curlobj = curl_init();
        curl_setopt($curlobj, CURLOPT_URL, $url);
        // curl_setopt($curlobj, CURLOPT_HEADER, 0);
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1);
        // 验证
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYHOST, 0);
        $res = curl_exec($curlobj);
        curl_close($curlobj);
        return $res;
    }
}
