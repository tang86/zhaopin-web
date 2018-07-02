<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 02 Jul 2018 15:16:36 +0800.
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
		'remark'
	];

	public function credit_config()
	{
		return $this->belongsTo(\App\Models\CreditConfig::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
