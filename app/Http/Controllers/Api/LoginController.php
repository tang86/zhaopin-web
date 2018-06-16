<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * 说明: 用户登录，没有则注册
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function login(LoginRequest $request)
    {
        // 判断当前用户open_id是否已经存在
        $user = User::where('open_id', $request->open_id)->first();
        // 存在返回私人令牌、修改资料
        if (!empty($user) || (!empty($request->union_id) && !empty($user = User::where('union_id', $request->union_id)->first()))) {
            $user->head_url = $request->head_url;
            $user->name = $request->name;
            if (!empty($request->union_id)) {
                $user->union_id = $request->union_id;
                $user->open_id = $request->open_id;
            }
            $user->save();

            if ($user->status != 1) {
                return $this->sendError('账号禁用', ['账号禁用'], 403);
            }

            // 获取令牌
            $token = $user->createToken($request->open_id)->accessToken;
            return $this->sendResponse(['_token' => $token, 'user' => $user], '登陆成功');
        }
        // 不存在添加用户、返回私人令牌
        $user = User::create([
            'open_id' => $request->open_id,
            'union_id' => $request->union_id??null,
            'name' => $request->name,
            'head_url' => $request->head_url,
        ]);

        if (empty($user)) {
            return $this->sendError('登录失败', ['用户注册失败'], 500);
        }

        // 获取令牌
        $token = $user->createToken($request->open_id)->accessToken;
        return $this->sendResponse(['_token' => $token, 'user' => $user], '登陆成功');
    }
}
