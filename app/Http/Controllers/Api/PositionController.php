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
            ->with('company')
            ->with('district')
            ->with('salary')
            ->orderBy('sort', 'desc')
            ->paginate($page_size);

        if(!empty($data)){
            foreach ($data as &$item) {
                $item['keywords_arr'] = explode(' ', $item['keywords']);
            }

            return $this->sendResponse($data, '获取成功！');
        }
        return $this->sendResponse(false, '没有数据！');
    }

    public function show(Position $position)
    {
        $position->company;
        $position->district;
        $position->salary;
        $position->company->company_category;
        $position->company->company_size;
        $position->company->company_status;
        $position->company->district;

        $position['keywords_arr'] = explode(' ', $position->keywords);

        return $this->sendResponse($position, '获取详情成功');
    }


}
