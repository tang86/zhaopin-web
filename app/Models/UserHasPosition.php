<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 30 Jun 2018 10:20:54 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserHasPosition
 * 
 * @property int $id
 * @property int $user_id
 * @property int $position_id
 * 
 * @property \App\Models\Position $position
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class UserHasPosition extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'position_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'position_id'
	];

	public function position()
	{
		return $this->belongsTo(Position::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
