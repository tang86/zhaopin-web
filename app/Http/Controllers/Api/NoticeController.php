<?php

namespace App\Http\Controllers\Api;

use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    public function getNotices(Request $request)
    {
        $data = Notice::orderByDesc('updated_at')
            ->limit($request->num??3)
            ->get();
        if(!empty($data)){

            return $this->sendResponse($data, '获取数据成功！');
        }
        return $this->sendResponse(false, '没有数据！');
    }
}
