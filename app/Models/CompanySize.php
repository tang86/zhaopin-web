<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 24 Jun 2018 12:56:00 +0800.
 */

namespace App\Models;

use App\Models\Traits\FormOptions;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CompanySize
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property int $sort
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $min
 * @property int $max
 * 
 * @property \Illuminate\Database\Eloquent\Collection $companies
 *
 * @package App\Models
 */
class CompanySize extends Eloquent
{
    use FormOptions;

	protected $table = 'company_size';

	protected $casts = [
		'status' => 'int',
		'sort' => 'int',
		'min' => 'int',
		'max' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'min',
		'max'
	];

	public function companies()
	{
		return $this->hasMany(Company::class);
	}

}
