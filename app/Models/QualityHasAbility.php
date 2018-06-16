<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 02 May 2018 14:39:49 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class QualityHasAbility
 * 
 * @property int $quality_id
 * @property int $ability_id
 * @property int $type_id
 *
 * @package App\Models
 */
class QualityHasAbility extends Eloquent
{
	protected $table = 'quality_has_ability';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'quality_id' => 'int',
		'ability_id' => 'int',
		'type_id' => 'int'
	];

	protected $fillable = [
		'type_id'
	];
}
