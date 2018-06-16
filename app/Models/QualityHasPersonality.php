<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 02 May 2018 15:10:43 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class QualityHasPersonality
 * 
 * @property int $quality_id
 * @property int $personality_id
 * @property float $ratio
 *
 * @package App\Models
 */
class QualityHasPersonality extends Eloquent
{
	protected $table = 'quality_has_personality';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'quality_id' => 'int',
		'personality_id' => 'int',
		'ratio' => 'float'
	];

	protected $fillable = [
		'ratio'
	];
}
