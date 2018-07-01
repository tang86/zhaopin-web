<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 01 Jul 2018 15:55:09 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Experience
 * 
 * @property int $id
 * @property string $company_name
 * @property string $category_name
 * @property string $description
 * @property int $started_at
 * @property int $ended_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $resume_id
 * @property int $user_id
 * 
 * @property \App\Models\Resume $resume
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Experience extends Eloquent
{
	protected $casts = [
		'started_at' => 'int',
		'ended_at' => 'int',
		'resume_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'company_name',
		'category_name',
		'description',
		'started_at',
		'ended_at',
		'resume_id',
		'user_id'
	];

	public function resume()
	{
		return $this->belongsTo(\App\Models\Resume::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
