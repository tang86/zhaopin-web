<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 01 Jul 2018 21:57:03 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserHasPosition
 * 
 * @property int $id
 * @property int $user_id
 * @property int $position_id
 * @property int $resume_id
 * 
 * @property \App\Models\Resume $resume
 * @property \App\Models\User $user
 * @property \App\Models\Position $position
 *
 * @package App\Models
 */
class UserHasPosition extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'position_id' => 'int',
		'resume_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'position_id',
		'resume_id'
	];

	public function resume()
	{
		return $this->belongsTo(\App\Models\Resume::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function position()
	{
		return $this->belongsTo(\App\Models\Position::class);
	}
}
