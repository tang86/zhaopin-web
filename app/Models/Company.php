<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 16 Jun 2018 17:08:38 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Company
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property int $created_at
 * @property int $updated_at
 * @property int $sort
 * @property string $logo
 * @property string $number
 * @property string $profile
 * @property string $phone
 * @property string $wechat
 * @property string $qq
 *
 * @package App\Models
 */
class Company extends Eloquent
{
	protected $casts = [
		'status' => 'int',
//		'created_at' => 'int',
//		'updated_at' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'logo',
		'number',
		'profile',
		'phone',
		'wechat',
		'qq'
	];

    public function setProfileAttribute($profile)
    {
        if (is_array($profile)) {
            $this->attributes['profile'] = json_encode($profile);
        }
    }

    public function getProfileAttribute($profile)
    {
        return json_decode($profile, true);
    }
}
