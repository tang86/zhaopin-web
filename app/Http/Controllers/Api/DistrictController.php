<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function index()
    {
        $data = [
            'all' => [],
        'provinces' => [],
        'cities' => [],
        ];
        $districts = District::where(['parent_id' => 0])
            ->with('districts')
            ->get();
        $data['all'] = $districts;
        foreach ($districts as $district) {
            $data['provinces'][$district->id] = $district->name;
            $data['cities'][$district->id] = $district->districts;
        }

        return $this->sendResponse($data, '获取成功');
    }
}
