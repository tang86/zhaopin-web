<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 22 Jun 2018 15:46:57 +0800.
 */

namespace App\Models;

use App\Models\Traits\FormOptions;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Company
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $logo
 * @property string $number
 * @property string $profile
 * @property string $phone
 * @property string $wechat
 * @property string $qq
 * @property int $company_category_id
 * @property int $company_status_id
 * @property int $company_size_id
 * @property string $imgs
 * @property int $sort
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $district_id
 * 
 * @property CompanyCategory $company_category
 * @property CompanySize $company_size
 * @property CompanyStatus $company_status
 * @property District $district
 *
 * @package App\Models
 */
class Company extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'company_category_id' => 'int',
		'company_status_id' => 'int',
		'company_size_id' => 'int',
		'sort' => 'int',
		'district_id' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'logo',
		'number',
		'profile',
		'phone',
		'wechat',
		'qq',
		'company_category_id',
		'company_status_id',
		'company_size_id',
		'imgs',
		'sort',
		'remark',
		'district_id'
	];

	use FormOptions;

	public function company_category()
	{
		return $this->belongsTo(CompanyCategory::class);
	}

	public function company_size()
	{
		return $this->belongsTo(CompanySize::class);
	}

	public function company_status()
	{
		return $this->belongsTo(CompanyStatus::class);
	}

	public function district()
	{
		return $this->belongsTo(District::class);
	}

    public function setImgsAttribute($imgs)
    {
        if (is_array($imgs)) {
            $this->attributes['imgs'] = json_encode($imgs);
        }
    }

    public function getImgsAttribute($imgs)
    {
        return json_decode($imgs, true);
    }
}
