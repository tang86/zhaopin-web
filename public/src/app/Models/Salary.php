<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 29 Jun 2018 16:02:43 +0800.
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
 * @property int $sort
 * @property float $floor
 * @property float $ceil
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $positions
 *
 * @package App\Models
 */
class Salary extends Eloquent
{
    use FormOptions;

	protected $casts = [
		'status' => 'int',
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

	public function positions()
	{
		return $this->hasMany(Position::class);
	}
}
