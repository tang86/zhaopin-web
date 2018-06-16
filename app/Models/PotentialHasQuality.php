<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 22 May 2018 21:44:53 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PotentialHasQuality
 * 
 * @property int $id
 * @property int $potential_id
 * @property int $quality_id
 * @property string $potential_name
 * @property string $quality_name
 * @property string $quality_description
 *
 * @package App\Models
 */
class PotentialHasQuality extends Eloquent
{
	protected $table = 'potential_has_quality';
	public $timestamps = false;

	protected $casts = [
		'potential_id' => 'int',
		'quality_id' => 'int'
	];

	protected $fillable = [
		'potential_id',
		'quality_id',
		'potential_name',
		'quality_name',
		'quality_description'
	];
}
