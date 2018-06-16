<?php

namespace App\Http\Controllers\Api;

use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /**
     * 商品列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @author jy
     */
    public function index(Request $request)
    {
        $data = Good::orderBy('created_at')
            ->paginate($request->per_page??10);
        foreach ($data as $val) {
            $val->goods_image = url('uploads/'.$val->goods_image);
        }
        return $this->sendResponse($data, '获取的商品列表成功！');
    }

    /**
     * 商品详情
     *
     * @param Good $good
     * @return \Illuminate\Http\JsonResponse
     * @author jy
     */
    public function show(Good $good)
    {
        $good->goods_image = url('uploads/'.$good->goods_image);

        return $this->sendResponse($good, '获取商品详情成功');
    }
}
