<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 02 Jul 2018 17:30:22 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserPointsLog
 * 
 * @property int $id
 * @property int $user_id
 * @property int $credit_config_id
 * @property int $points
 * @property int $status
 * @property string $remark
 * @property string $code
 * 
 * @property \App\Models\CreditConfig $credit_config
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class UserPointsLog extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'credit_config_id' => 'int',
		'points' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'user_id',
		'credit_config_id',
		'points',
		'status',
		'remark',
		'code'
	];

	public function credit_config()
	{
		return $this->belongsTo(\App\Models\CreditConfig::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	static public function add($user_id, CreditConfig $credit_config, $code, $status = 1)
    {
        $user_points_log = new UserPointsLog();
        $user_points_log->user_id = $user_id;
        $user_points_log->points = $credit_config->points;
        $user_points_log->code = $code;
        $user_points_log->status = $status;
        $user_points_log->remark = $credit_config->name;
        $user_points_log->credit_config_id = $credit_config->id;
        return $user_points_log->save();

    }
    static public function canIAdd($user_id, CreditConfig $credit_config, $code)
    {
        if ($credit_config->max > 0) {
            $where = [
                'user_id' => $user_id,
                'code' => $code,
                'credit_config_id' => $credit_config->id
            ];
            $count = UserPointsLog::where($where)->count();
            if ($count >= $credit_config->max) {
                return false;
            }
        }

        return true;

    }
}
