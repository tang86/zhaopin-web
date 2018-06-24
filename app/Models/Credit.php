<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 24 Jun 2018 18:06:32 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Credit
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $sort
 * @property int $points
 * 
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Credit extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'sort' => 'int',
		'points' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'points'
	];

	public function users()
	{
		return $this->belongsToMany(\App\Models\User::class, 'user_has_credits')
					->withPivot('id', 'points');
	}
}
