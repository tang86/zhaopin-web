<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrdersRequest;
use Ramsey\Uuid\Uuid;
use App\Models\Order;
use App\Models\Good;
use App\user;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index(Request $request)
    {

    }

    public function store(OrdersRequest $request)
    {
        $user = Auth::guard('api')->user();

        $data = [
            'order_id' => Uuid::uuid1()->getHex(),
            'user_id' => $user->id,
            'goods_id' => $request->goods_id,
            'price_level' => $request->price_level??1,
            'price' => $request->price??0.00,
            'paid_price' => $request->paid_price??0.00,
            'coupon_price' => $request->coupon_price??0.00,
        ];
        Order::create($data);
        return $this->sendResponse($data, '下单成功');
    }
}
