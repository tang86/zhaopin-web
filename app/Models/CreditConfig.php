<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 02 Jul 2018 15:14:36 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CreditConfig
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
 * @property \Illuminate\Database\Eloquent\Collection $user_points_logs
 *
 * @package App\Models
 */
class CreditConfig extends Eloquent
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

	public function user_points_logs()
	{
		return $this->hasMany(\App\Models\UserPointsLog::class);
	}
}
