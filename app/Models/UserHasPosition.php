<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 15:44:20 +0800.
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
 * @property int $expired
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
		'resume_id' => 'int',
		'expired' => 'int'
	];

	protected $fillable = [
		'user_id',
		'position_id',
		'resume_id',
		'expired'
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
