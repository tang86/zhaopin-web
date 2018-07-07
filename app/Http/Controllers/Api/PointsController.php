<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPointsLog;
use App\Models\CreditConfig;
use Illuminate\Support\Facades\Auth;

class PointsController extends Controller
{
    public function inviteLogs()
    {
        $user = Auth::guard('api')->user();
        $where = [
            'user_id' => $user->id,
            'credit_config_id' => 2,
        ];
        $invite_user_points_logs = UserPointsLog::where($where)->orderByDesc('id')->get();
        $where['credit_config_id'] = 4;
        $resume_user_codes = UserPointsLog::where($where)->orderByDesc('id')->get()->pluck('code');
        if ($resume_user_codes) {
            $resume_user_codes = $resume_user_codes->toArray();
        } else {
            $resume_user_codes = [];
        }

        $credit_config_resume = CreditConfig::where(['id' => 4])->first();

        $complete_resume_number = 0;
        $points = 0;
        foreach ($invite_user_points_logs as &$invite_user_points_log) {
            $points += $invite_user_points_log->points;
            $id = str_replace('user_id_','', $invite_user_points_log->code)?:1;
            $invite_user_points_log['user'] = User::where(['id' => $id])->first();
            if (in_array($invite_user_points_log->code, $resume_user_codes)) {
                $invite_user_points_log['complete_resume'] = true;
                $complete_resume_number++;
                $points += $credit_config_resume->points;

            } else {
                $invite_user_points_log['complete_resume'] = false;
            }
        }

        $data = [
            'invite_user_points_logs' => $invite_user_points_logs,
            'complete_resume_number' => $complete_resume_number,
            'invite_users' => count($invite_user_points_logs),
            'points' => $points,
        ];

        return $this->sendResponse($data, '查询成功');
    }

    public function withdrawLogs(Request $request)
    {
        $user = Auth::guard('api')->user();
        $page_size = $request->page_size?:10;

        $where = [
            'user_id' => $user->id,
            'credit_config_id' => 0,
        ];
        $user_points_logs = UserPointsLog::where($where)->orderByDesc('id')->paginate($page_size);
        foreach ($user_points_logs as &$user_points_log) {
            list($user_points_log['date'], $user_points_log['time']) = explode(' ', $user_points_log->created_at);
            $user_points_log['status_name'] = CreditConfig::$STATUS[$user_points_log->status];
            $user_points_log['money'] = str_replace('积分兑换：', '', $user_points_log->remark);
        }
        return $this->sendResponse($user_points_logs, '查询成功');
    }

    public function pointsLogs(Request $request)
    {
        $user = Auth::guard('api')->user();
        $page_size = $request->page_size?:10;
        $where = [
            'user_id' => $user->id
        ];
        $user_points_logs = UserPointsLog::where($where)->orderByDesc('id')->paginate($page_size);
        return $this->sendResponse($user_points_logs, '查询成功');
    }

    public function pointsFriendResumeLogs()
    {

    }

    public function increasePointsRead(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $credit_config = CreditConfig::find(1);
        $user->points += $credit_config->points;
        $user->save();
        if (UserPointsLog::canIAdd($user->id, $credit_config, $request->get('code'))) {
            UserPointsLog::add($user->id, $credit_config, $request->get('code'));
            $message = '添加';
        } else {
            $message = '没有添加';
        }
        return $this->sendResponse($message, '修改成功');
    }
    public function increasePointsInvite(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $credit_config = CreditConfig::find(2);
        $user->points += $credit_config->points;
        $user->save();
        if (UserPointsLog::canIAdd($user->id, $credit_config, $request->get('code'))) {
            UserPointsLog::add($user->id, $credit_config, $request->get('code'));
            $message = '添加';
        } else {
            $message = '没有添加';
        }
        return $this->sendResponse($message, '修改成功');
    }
    public function increasePointsResume(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $credit_config = CreditConfig::find(3);
        $user->points += $credit_config->points;
        $user->save();
        if (UserPointsLog::canIAdd($user->id, $credit_config, $request->get('code'))) {
            UserPointsLog::add($user->id, $credit_config, $request->get('code'));
            $message = '添加';
        } else {
            $message = '没有添加';
        }
        return $this->sendResponse($message, '修改成功');
    }
    public function increasePointsFriendResume(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $credit_config = CreditConfig::find(4);
        $user->points += $credit_config->points;
        $user->save();
        if (UserPointsLog::canIAdd($user->id, $credit_config, $request->get('code'))) {
            UserPointsLog::add($user->id, $credit_config, $request->get('code'));
            $message = '添加';
        } else {
            $message = '没有添加';
        }
        return $this->sendResponse($message, '修改成功');
    }
    public function increasePointsShare(UserRequest $request)
    {
        $user = Auth::guard('api')->user();
        $credit_config = CreditConfig::find(5);
        $user->points += $credit_config->points;
        $user->save();
        if (UserPointsLog::canIAdd($user->id, $credit_config, $request->get('code'))) {
            UserPointsLog::add($user->id, $credit_config, $request->get('code'));
            $message = '添加';
        } else {
            $message = '没有添加';
        }
        return $this->sendResponse($message, '修改成功');
    }
}
