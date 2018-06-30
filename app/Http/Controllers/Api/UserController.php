<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\Credit;
use App\Models\Report;
use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\UserHasCredit;
use App\Models\UserHasPosition;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 说明: 用户提交信息
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function update(UserRequest $request)
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

        return $this->sendResponse($request->all(), '修改成功');
    }

    public function increasePointsRead()
    {
        $user = Auth::guard('api')->user();
        $credit = Credit::find(1);
        $user->points += $credit->points;
        $user->save();
        UserHasCredit::logPoints($user->id, $credit);
        return $this->sendResponse($user, '修改成功');
    }

    public function withdraw(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        if ($request->points > $user->points) {
            return $this->sendResponse(false, '积分不足');
        } else {
            $user->points -= $request->points;
            $user->save();

            return $this->sendResponse($user, '修改成功');
        }


    }

    public function points(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        return $this->sendResponse(['points'=>$user->points], '查询成功');

    }

    public function sendResume(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $position_id = $request->post('position_id');

        $user_has_position = new UserHasPosition();
        $user_has_position->position_id = $position_id;
        $user_has_position->user_id = $user->id;
        $user_has_position->save();

        return $this->sendResponse([], '投递成功');
    }

    public function updateResume(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $resume = Resume::firstOrNew(['user_id' => $user->id ]);
        if ($request->has('name')) {
            $resume->name = $request->post('name');
        }

        $resume->save();

        return $this->sendResponse([], '更新成功');
    }
}
