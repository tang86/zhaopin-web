<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 23 Jun 2018 23:05:01 +0800.
 */

namespace App\Models;

use App\Models\Traits\FormOptions;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Salary
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property int $created_at
 * @property int $updated_at
 * @property int $sort
 * @property float $floor
 * @property float $ceil
 *
 * @package App\Models
 */
class Salary extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'created_at' => 'int',
		'updated_at' => 'int',
		'sort' => 'int',
		'floor' => 'float',
		'ceil' => 'float'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'floor',
		'ceil'
	];

	use FormOptions;
}
