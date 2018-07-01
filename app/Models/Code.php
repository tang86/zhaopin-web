<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 01 Jul 2018 13:05:01 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Code
 * 
 * @property int $id
 * @property string $mobile
 * @property string $code
 * @property string $type_name
 * @property int $expired
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Code extends Eloquent
{
	protected $casts = [
		'expired' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'mobile',
		'code',
		'type_name',
		'expired',
		'status'
	];
}
