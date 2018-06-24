<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 24 Jun 2018 21:12:26 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserHasCredit
 * 
 * @property int $id
 * @property int $user_id
 * @property int $credit_id
 * @property int $points
 * @property int $status
 * @property string $remark
 * 
 * @property \App\Models\Credit $credit
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class UserHasCredit extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'credit_id' => 'int',
		'points' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'user_id',
		'credit_id',
		'points',
		'status',
		'remark'
	];

	public function credit()
	{
		return $this->belongsTo(Credit::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

    static public function logPoints($user_id,Credit $credit)
    {

        $log = new static();
        $log->user_id = $user_id;
        $log->points = $credit->points;
        $log->credit_id = $credit->id;
        $log->status = 1;
        $log->remark = $credit->name;
        $log->save();
    }

    static public function withDrawPoints($points, $user_id)
    {

        $log = new static();
        $log->user_id = $user_id;
        $log->points = $points;
        $log->credit_id = 0;
        $log->status = 0;
        $log->remark = '提现';
        $log->save();
    }
}
