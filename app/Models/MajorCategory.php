<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 10:08:43 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MajorCategory
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property int $created_at
 * @property int $updated_at
 * @property int $sort
 * @property string $code
 *
 * @package App\Models
 */
class MajorCategory extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'created_at' => 'int',
		'updated_at' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'code'
	];
}
