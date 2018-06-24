<?php

namespace App\Http\Controllers\Api;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $page_size = $request->page_size??10;
        $data = Position::where('status', 1)
            ->orderBy('sort', 'desc')
            ->paginate($page_size);

        if(!empty($data)){

            return $this->sendResponse($data, '获取成功！');
        }
        return $this->sendResponse(false, '没有数据！');
    }

    public function show(Position $position)
    {
        return $this->sendResponse($position, '获取详情成功');
    }


}
