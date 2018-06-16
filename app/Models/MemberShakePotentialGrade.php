<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 15 May 2018 10:22:03 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MemberShakePotentialGrade
 * 
 * @property int $member_id
 * @property int $shake_id
 * @property string $potential_ids
 * @property float $grade
 * @property int $weight
 * @property string $order_number
 *
 * @package App\Models
 */
class MemberShakePotentialGrade extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'member_id' => 'int',
		'shake_id' => 'int',
		'grade' => 'float',
		'weight' => 'int'
	];

	protected $fillable = [
		'potential_ids',
		'grade',
		'weight',
        'order_number',
	];
}
