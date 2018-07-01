<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\Credit;
use App\Models\Experience;
use App\Models\Report;
use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\ResumeHasPosition;
use App\Models\User;
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

        if ($request->has('mobile')) {
            $user->mobile = $request->post('mobile');
        }

        $user->save();

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

        $user = User::find($user->id);

        $user_has_position = new UserHasPosition();
        $user_has_position->position_id = $position_id;
        $user_has_position->user_id = $user->id;
        $user_has_position->resume_id = $user->resume->id;
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
        if ($request->has('gender')) {
            $resume->gender = $request->post('gender');
        }
        if ($request->has('age')) {
            $resume->age = $request->post('age');
        }
        if ($request->has('status')) {
            $resume->status = $request->post('status');
        }
        if ($request->has('workedDate')) {
            $resume->worked_at = strtotime($request->post('workedDate'));
        }


        $resume->save();

        return $this->sendResponse([], '更新成功');
    }

    public function mySentPositions(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $sent_positions = ResumeHasPosition::where(['user_id' => $user->id])
            ->with('resume')
            ->with('position')
            ->with('user')
            ->orderByDesc('id')
            ->get();
        return $this->sendResponse($sent_positions, '获取成功');
    }

    public function addExperience(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $resume = Resume::firstOrCreate(['user_id' => $user->id ]);
        $experience = new Experience();
        $experience->company_name = $request->post('company_name');
        $experience->category_name = $request->post('category_name');
        $experience->started_at = strtotime($request->post('startedDate'));
        $experience->ended_at = $request->post('endedDate')=='至今'?0:strtotime($request->post('endedDate'));
        $experience->description = $request->post('description');
        $experience->resume_id = $resume->id;
        $experience->user_id = $user->id;
        $experience->save();

        return $this->sendResponse($request->post(), '添加成功');
    }

    public function getResume(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $resume = Resume::firstOrCreate(['user_id' => $user->id ]);
        $resume->experiences;
        if ($resume->experiences) {
            foreach ($resume->experiences as &$experience) {
                $experience->started_date = date('Y-m', $experience->started_at);
                $experience->ended_date = $experience->ended_at > 0 ? date('Y-m', $experience->ended_at) : '今';
            }
        }
        $resume->worked_date = $resume->worked_at > 0 ? date('Y-m', $resume->worked_at) : '';

        $resume->user;
        $resume->user->genders = $resume->user->genders();
        return $this->sendResponse($resume, '添加成功');
    }
}
