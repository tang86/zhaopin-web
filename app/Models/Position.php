<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 29 Jun 2018 15:43:56 +0800.
 */

namespace App\Models;

use App\Models\Traits\FormOptions;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Position
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $sort
 * @property string $keywords
 * @property int $room_and_board
 * @property int $number
 * @property string $content
 * @property string $benefit
 * @property int $district_id
 * @property int $company_id
 * @property int $salary_id
 * 
 * @property \App\Models\Company $company
 * @property \App\Models\District $district
 * @property \App\Models\Salary $salary
 *
 * @package App\Models
 */
class Position extends Eloquent
{
    use FormOptions;

	protected $casts = [
		'status' => 'int',
		'sort' => 'int',
		'room_and_board' => 'int',
		'number' => 'int',
		'district_id' => 'int',
		'company_id' => 'int',
		'salary_id' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'keywords',
		'room_and_board',
		'number',
		'content',
		'benefit',
		'district_id',
		'company_id',
		'salary_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function district()
	{
		return $this->belongsTo(District::class);
	}

	public function salary()
	{
		return $this->belongsTo(Salary::class);
	}
}
