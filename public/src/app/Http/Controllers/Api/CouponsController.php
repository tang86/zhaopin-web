<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CouponsRequest;
use App\Models\Coupon;
use App\Models\CouponsRelUser;
use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class CouponsController extends Controller
{
    /**
     * 说明: 生成优惠券
     *
     * @param CouponsRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function store(CouponsRequest $request)
    {
        $goods = Good::find($request->goods_id);
        if (empty($goods)) {
            return $this->sendError('商品不存在', $errors = ['商品不存在']);
        }

        $user = Auth::guard('api')->user();

        $data = [
            'id' => Uuid::uuid1()->getHex(),
            'user_id' => $user->id,
            'goods_id' => $request->goods_id,
            'min' => $goods->min,
            'max' => $goods->max,
            'expire_start' => strtotime($request->expire_start),
            'expire_end' => strtotime($request->expire_end),
            'remark' => $request->remark
        ];
        Coupon::create($data);
        return $this->sendResponse($data, '生成优惠券成功');
    }

    /**
     * 说明: 领取优惠券
     *
     * @param Coupon $coupon
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function getCoupon(Coupon $coupon)
    {
        $user = Auth::guard('api')->user();
        // 判断是否已经领取过了
        if (empty(CouponsRelUser::where(['user_id' => $user->id, 'coupon_id' => $coupon->id])->first())) {
            return $this->sendError('已经领取过了', $errors = ['已经领取过了'], 403);
        }

        $data = [
            'coupon_id' => $coupon->id,
            'user_id' => $user->id,
            'price' => rand($coupon->min, $coupon->max)
        ];
        CouponsRelUser::create($data);
        return $this->sendResponse($data, '领取优惠券成功');
    }

    /**
     * 说明: 我的优惠券
     *
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function myCoupons()
    {
        $user = Auth::guard('api')->user();

        $data = CouponsRelUser::where('user_id', $user->id)->paginate(10);
        $coupons = $data->map(function ($item) {
            return CouponsRelUser::getItems($item);
        });
        $data = $data->toArray();
        $data['data'] = $coupons;
        return $this->sendResponse($data, '获取我的优惠券成功');
    }
}
