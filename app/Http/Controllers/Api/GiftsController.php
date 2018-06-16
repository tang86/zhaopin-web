<?php

namespace App\Http\Controllers\Api;

use App\Models\Gift;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GiftsController extends Controller
{
    /**
     * 说明: 我送出的礼物
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function sendOrders(Request $request)
    {
        $user = Auth::guard('api')->user();

        if (empty($user->sendOrders->count())) {
            return $this->sendResponse([
                'data' => [],
                'last_page' => 1,
                'current_page' => 1,
                'next_page_url' => ''
            ], '获取我送出的礼物完成');
        }

        $gifts = Gift::where('send_user', $user->id)->paginate($request->per_page??10);
        $data = $gifts->map(function ($gift) {
            $order = Order::find($gift->order_id);
            $order->send_time = $gift->created_at;
            $order->title = $order->goods->goods_name??'';
            $order->banner = url('uploads/' . $order->goods->goods_image??'');
            $user = User::find($gift->receive_user);
            if (!empty($user)) {
                $user->receive_time = $gift->updated_at->toDateTimeString();
                $subject = $user->subjects->where('order_number', '=', $order->order_id)->first();
                $user->subject_status = $subject->subject_status??0;
            }
            return [
                'order' => $order,
                'user' => $user
            ];
        });

        $result = $gifts->toArray();
        $result['data'] = $data;
        return $this->sendResponse($result, '获取我送出的礼物完成');
    }

    /**
     * 说明: 我收到的礼物
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function receiveOrders(Request $request)
    {
        $now_user = Auth::guard('api')->user();
        if (empty($now_user->receiveOrders->count())) {
            return $this->sendResponse([
                'data' => [],
                'last_page' => 1,
                'current_page' => 1,
                'next_page_url' => ''
            ], '获取我收到的礼物完成');
        }

        $gifts = Gift::where('receive_user', $now_user->id)->paginate($request->per_page??10);
        $data = $gifts->map(function ($gift) use($now_user){
            $order = Order::find($gift->order_id);
            $order->send_time = $gift->created_at;
            $order->receive_time = $gift->updated_at;
            $order->banner = url('uploads/' . $order->goods->goods_image??'');

            $user = User::find($gift->send_user);
            if (!empty($user)) {
                $user->receive_time = $gift->updated_at->toDateTimeString();
                $user->send_time = $gift->updated_at;
                $subject = $now_user->subjects->where('order_number', '=', $order->order_id)->first();
                $user->subject_status = $subject->subject_status??0;
            }
            return [
                'order' => $order,
                'user' => $user
            ];
        });
        $result = $gifts->toArray();
        $result['data'] = $data;
        return $this->sendResponse($result, '获取我送出的礼物完成');
    }

    /**
     * 说明: 发送礼物操作
     *
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function send(Order $order)
    {
        $This = $this;
        DB::beginTransaction();
        try {
            if ($order->order_status != 1) {
                return $This->sendError('该测评卡无效！', ['该测评卡无效!'], 500);
            }
            $order->order_status = 3;
            $order->save();

            if (!empty($gift = Gift::where([
                'order_id' => $order->id,
                'send_user' => Auth::guard('api')->user()->id,
            ])->first())
            ) {
                return $This->sendResponse($gift, '发送礼物成功！');
            }

            $gift = Gift::create([
                'order_id' => $order->id,
                'send_user' => Auth::guard('api')->user()->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return $This->sendError('发送礼物失败！', ['发送礼物失败!'], 500);
        }
        return $This->sendResponse($gift, '发送礼物成功！');
    }

    /**
     * 说明: 领取礼物
     *
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function store(Order $order)
    {
        // 判断该测评卡有没有没领取
        $gift = Gift::where(['order_id' => $order->id])->first();
        if (!empty($gift->receive_user)) {
            return $this->sendError('该礼物已被他人领取！', ['该礼物已被他人领取!'], 403);
        }

        $user = Auth::guard('api')->user();
        // 不让领取自己的
        if ($gift->send_user == $user->id) {
            return $this->sendError('不可领取自己的礼物！', ['不可领取自己的礼物!'], 403);
        }

        $order = Order::findOrFail($gift->order_id);
        DB::beginTransaction();
        try {
            $gift->receive_user = $user->id;
            $gift->save();

            $order->order_status = 1;
            $order->user_id = $user->id;
            $order->save();
            DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return $this->sendError('领取礼物失败！', ['领取礼物失败!'], 500);
        }
        return $this->sendResponse($gift, '领取礼物成功！');
    }
}
