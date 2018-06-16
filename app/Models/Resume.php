<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 16 Jun 2018 17:08:38 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Resume
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property int $created_at
 * @property int $updated_at
 * @property int $sort
 * @property int $worked_at
 * @property int $user_id
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Resume extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'created_at' => 'int',
		'updated_at' => 'int',
		'sort' => 'int',
		'worked_at' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'worked_at',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
