<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 24 Jun 2018 18:07:41 +0800.
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
		'points' => 'int'
	];

	protected $fillable = [
		'user_id',
		'credit_id',
		'points'
	];

	public function credit()
	{
		return $this->belongsTo(\App\Models\Credit::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
