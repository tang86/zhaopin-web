<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 22 Jun 2018 13:52:42 +0800.
 */

namespace App\Models;


use Reliese\Database\Eloquent\Model as Eloquent;
use App\Models\Traits\FormOptions;

/**
 * Class CompanyCategory
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $sort
 *
 * @package App\Models
 */
class CompanyCategory extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort'
	];

	use FormOptions;


}
