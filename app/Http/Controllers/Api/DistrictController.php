<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function index()
    {

        $data = [];
        $where = [
            'parent_id' => 0
        ];
        $districts = District::where($where)
            ->with('districts')
            ->get();


        foreach ($districts as $district) {
            $data['all'][] = $district;
            $data['provinces'][$district->id] = $district->name;
            $data['cities'][$district->id] = $district->districts;
        }

        return $this->sendResponse($data, '获取成功');
    }
}
