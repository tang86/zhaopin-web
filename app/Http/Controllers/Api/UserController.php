<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\Experience;
use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\User;
use App\Models\UserHasPosition;
use App\Models\UserPointsLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


    public function withdraw(UserRequest $request)
    {
        $user = Auth::guard('api')->user();

        $withdraw_points = $request->money / config('credit.rate');

        if ($withdraw_points > $user->points) {
            return $this->sendResponse(false, '积分不足');
        } else {
            $user->points -= $withdraw_points;
            $user->save();
            //
            DB::update('SET FOREIGN_KEY_CHECKS=0;');
            $user_points_log = new UserPointsLog();
            $user_points_log->user_id = $user->id;
            $user_points_log->credit_config_id = 0;
            $user_points_log->points = -($withdraw_points);
            $user_points_log->remark = "积分兑换：{$request->money} 元";
            $user_points_log->code = "withdraw_user_id_{$user->id}";

            $user_points_log->save();

            //返回
            $data = [
                'points' => $user->points,
                'money' => $user->points * config('credit.rate')
            ];
            return $this->sendResponse($data, '修改成功');
        }


    }

    public function points(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $data = [
            'points' => $user->points,
            'money' => $user->points * config('credit.rate')
        ];
        return $this->sendResponse($data, '查询成功');

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
        if ($request->has('city')) {
            $resume->city = $request->post('city');
        }
        if ($request->has('intentions_name')) {
            $resume->intentions_name = $request->post('intentions_name');
        }

        $resume->save();

        $resume->is_complete = $resume->isComplete();
        return $this->sendResponse($resume, '更新成功');
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

        if (count($resume->experiences) > 0) {
            $resume->experience_year = ceil((time() - $resume->experiences[0]->started_at)/(60*60*24*365));
            foreach ($resume->experiences as &$experience) {
                $experience->started_date = date('Y-m', $experience->started_at);
                $experience->ended_date = $experience->ended_at > 0 ? date('Y-m', $experience->ended_at) : '今';
            }
        }
        $resume->worked_date = $resume->worked_at > 0 ? date('Y-m', $resume->worked_at) : '';

        $resume->user;
        $resume->user->genders = $resume->user->genders();
        $resume->status_name = Resume::$STATUS[$resume->status];
        $resume->is_complete = $resume->isComplete();

        return $this->sendResponse($resume, '添加成功');
    }

    public function hasResume()
    {
        $user = Auth::guard('api')->user();
        $resume = Resume::where(['user_id' => $user->id ])->first();
        if ($resume) {
            $resume->is_complete = $resume->isComplete();
            return $this->sendResponse($resume, '有简历');
        } else {
            return $this->sendResponse(['status'=>0], '无简历');
        }
    }

    public function bindMobile(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        //检查用户手机号是否已经绑定
        $where = [
            'mobile' => $request->mobile
        ];
        $bind_user = User::where($where)->first();
        if ($bind_user) {
            return $this->sendResponse(['status' => 0], '手机号已经注册');
        }

        $user->mobile = $request->mobile;
        $user->save();
        return $this->sendResponse(['status' => 1], '手机号绑定成功');
    }
}
