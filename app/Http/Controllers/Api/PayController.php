<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Order;
use Ramsey\Uuid\Uuid;
use function EasyWeChat\Kernel\Support\generate_sign;

class PayController extends Controller
{
    /**
     * 测评支付微信统一下单
     *
     * @param Request $request
     * @return array
     */
    public function createWechatOrder(Request $request)
    {
        $data = $request->all();
        // 判断价格
        if($data['price_level'] == "3") {
            $paid_price = $data['activity_price'];

        } else if($data['price_level'] == "2"){
            $paid_price = $data['price'];
        } else {
            $paid_price = $data['price'];
        }

        $payment = \EasyWeChat::payment(); // 微信支付
        $orderId = Uuid::uuid1()->getHex();
        $result = $payment->order->unify([
            'body'         => $data['goodName'],
            'out_trade_no' => $orderId,
            'trade_type'   => 'JSAPI',  // 必须为JSAPI
            'openid'       => $data['openId'], // 这里的openid为付款人的openid
            'total_fee'    => intval($paid_price)*100,                // 算完优惠卷的价格
        ]);

        // 如果成功生成统一下单的订单，那么进行二次签名
        if ($result['return_code'] === 'SUCCESS') {

            $user = User::where(['open_id'=>$data['openId']])->first()->toArray();
            if (empty($user)) return $this->sendResponse(false,'请先登录！');

            $order = [
                'order_id'     => $orderId,
                'goods_id'     => $data['goodsId'],
                'class_id'     => $data['class_id'],
                'user_id'      => $user['id'],
                'price'        => $data['price'],
                'price_level'  => $data['price_level'],
                'paid_price'   => $paid_price
            ];

            $status = Order::create($order);

            if(!$status) return $this->sendResponse(false,'请稍后重试');

            // 二次签名的参数必须与下面相同
            $params = [
                'appId'     => config('wechat.payment.default.app_id'),
                'timeStamp' => time(),
                'nonceStr'  => $result['nonce_str'],
                'package'   => 'prepay_id=' . $result['prepay_id'],
                'signType'  => 'MD5',
            ];

            // config('wechat.payment.default.key')为商户的key
            $params['paySign'] = generate_sign($params, config('wechat.payment.default.key'));
            $params['order'] = $order;
            return $params;
        } else {
            return $result;
        }
    }

    /**
     * xml字符串转参数数组
     * @param string $xml xml字符串
     * @return array|bool
     */
    public function xml2array($xml) {
        $result = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (!empty($result) && is_object($result)) return (array)$result;

        return false;
    }


    /**
     * 构造参数请求xml字符串
     * @param array $para 参数数组
     * @return string
     */
    public function array2xml($para) {
        $xml = "<xml>";
        foreach ($para as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";

        return $xml;
    }

    /**
     * 微信支付回调
     *
     * @return string
     */
    public function createOrderNotify()
    {
        $callback_string = file_get_contents('php://input');
        if (empty($callback_string))
        {
            echo "FAIL";exit;
        }
        $data = $this->xml2array($callback_string);
        if ($data==false)
        {
            echo "FAIL";exit;
        }
        \Log::debug($data);

        $order_id = $data['out_trade_no']; // 订单号
        $transaction_id = $data['transaction_id'];  // 微信订单号
        $openid = $data['openid'];  // 用户ID
        $user = User::where(['open_id'=>$openid])->first()->toArray();

        $order = Order::where(['order_id'=>$order_id,'user_id'=>$user['id']])->first()->toArray();
        if($order) {

            Order::where(['order_id'=>$order_id])->update(['order_status'=>1,'transaction_id'=>$transaction_id]);
        } else {
            \Log::debug('微信支付回调查询订单失败：{user_id：'.$user['id'].';open_id:'.$openid.';order_id:'.$order_id.';transaction_id:'.$transaction_id.'}');
            return "<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[FAIL]]></return_msg></xml>";
        }


        if ($data['result_code'] == 'SUCCESS' && $data['return_code'] == 'SUCCESS') {

            return "<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>";
        }else{
            \Log::debug('微信支付回调修改订单状态失败：{user_id：'.$user['id'].';open_id:'.$openid.';order_id:'.$order_id.',transaction_id:'.$transaction_id.'}');
            return "<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[FAIL]]></return_msg></xml>";
        }

    }


}
