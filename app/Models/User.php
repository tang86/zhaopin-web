<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 16 Jun 2018 17:08:38 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property int $dealer_id
 * @property int $inviter_id
 * @property string $sex
 * @property string $address
 * @property string $name
 * @property string $tel
 * @property string $password
 * @property string $open_id
 * @property string $weChat_id
 * @property string $ticket
 * @property string $union_id
 * @property string $poster_id
 * @property string $head_url
 * @property int $status
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $resumes
 *
 * @package App\Models
 */
class User extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'dealer_id' => 'int',
		'inviter_id' => 'int',
		'status' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'dealer_id',
		'inviter_id',
		'sex',
		'address',
		'name',
		'tel',
		'password',
		'open_id',
		'weChat_id',
		'ticket',
		'union_id',
		'poster_id',
		'head_url',
		'status',
		'remember_token'
	];

	public function resumes()
	{
		return $this->hasMany(\App\Models\Resume::class);
	}
}
