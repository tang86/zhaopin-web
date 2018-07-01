<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 01 Jul 2018 14:52:40 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ResumeHasExperience
 * 
 * @property int $id
 * @property int $resume_id
 * @property int $experience_id
 * 
 * @property \App\Models\Experience $experience
 * @property \App\Models\Resume $resume
 *
 * @package App\Models
 */
class ResumeHasExperience extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'resume_id' => 'int',
		'experience_id' => 'int'
	];

	protected $fillable = [
		'resume_id',
		'experience_id'
	];

	public function experience()
	{
		return $this->belongsTo(\App\Models\Experience::class);
	}

	public function resume()
	{
		return $this->belongsTo(\App\Models\Resume::class);
	}
}
