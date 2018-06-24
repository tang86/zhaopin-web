<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 24 Jun 2018 18:07:59 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ResumeHasPosition
 * 
 * @property int $resume_id
 * @property int $position_id
 * 
 * @property \App\Models\Position $position
 * @property \App\Models\Resume $resume
 *
 * @package App\Models
 */
class ResumeHasPosition extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'resume_id' => 'int',
		'position_id' => 'int'
	];

	public function position()
	{
		return $this->belongsTo(\App\Models\Position::class);
	}

	public function resume()
	{
		return $this->belongsTo(\App\Models\Resume::class);
	}
}
