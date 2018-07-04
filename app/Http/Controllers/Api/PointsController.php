<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPointsLog;
use App\Models\CreditConfig;
use Illuminate\Support\Facades\Auth;

class PointsController extends Controller
{
    public function pointsLogs()
    {
        $user = Auth::guard('api')->user();
        return $this->sendResponse(['points'=>$user->points], '查询成功');

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
