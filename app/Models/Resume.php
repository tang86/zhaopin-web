<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 01 Jul 2018 16:54:55 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Resume
 * 
 * @property int $id
 * @property string $name
 * @property string $gender
 * @property int $status
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $sort
 * @property int $worked_at
 * @property int $user_id
 * @property string $age
 * @property string $city
 * @property string $intentions_name
 * 
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $experiences
 * @property \Illuminate\Database\Eloquent\Collection $positions
 *
 * @package App\Models
 */
class Resume extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'sort' => 'int',
		'worked_at' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'gender',
		'status',
		'remark',
		'sort',
		'worked_at',
		'user_id',
		'age',
		'city',
		'intentions_name'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function experiences()
	{
		return $this->hasMany(\App\Models\Experience::class);
	}

	public function positions()
	{
		return $this->belongsToMany(\App\Models\Position::class, 'resume_has_positions')
					->withPivot('id', 'user_id');
	}
}
