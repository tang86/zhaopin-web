<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 24 Jun 2018 18:08:13 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ResumeHasExpCompany
 * 
 * @property int $resume_id
 * @property int $exp_company_id
 * 
 * @property \App\Models\ExpCompany $exp_company
 * @property \App\Models\Resume $resume
 *
 * @package App\Models
 */
class ResumeHasExpCompany extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'resume_id' => 'int',
		'exp_company_id' => 'int'
	];

	public function exp_company()
	{
		return $this->belongsTo(\App\Models\ExpCompany::class);
	}

	public function resume()
	{
		return $this->belongsTo(\App\Models\Resume::class);
	}
}
