<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UsersRequest;
use App\Models\Report;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * 说明: 用户提交信息
     *
     * @param UsersRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function update(UsersRequest $request)
    {
        $user = Auth::guard('api')->user();
        $data = [
            'order_number' => $request->order_number,
            'member_id' => $user->id,

        ];
        $report = Report::firstOrNew($data);
        $report->user_name = $request->name;
        $report->mobile = $request->tel;
        $report->gender = $request->sex;
        $report->address = $request->address;
        $report->save();

//        $result = User::where('id', $user->id)->update([
//            'name' => $request->name,
//            'sex' => $request->sex,
//            'tel' => $request->tel,
//            'address' => $request->address,
//        ]);
        return $this->sendResponse($request->all(), '修改成功');
    }
}
