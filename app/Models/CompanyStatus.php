<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 22 Jun 2018 13:52:33 +0800.
 */

namespace App\Models;

use App\Models\Traits\FormOptions;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CompanyStatus
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
class CompanyStatus extends Eloquent
{
	protected $table = 'company_status';

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
