<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 24 May 2018 09:15:49 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Report
 * 
 * @property int $id
 * @property int $created_at
 * @property int $subject_id
 * @property int $member_id
 * @property string $path
 * @property string $order_number
 *
 * @package App\Models
 */
class Report extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'created_at' => 'int',
		'subject_id' => 'int',
		'member_id' => 'int'
	];

	protected $fillable = [
		'subject_id',
		'member_id',
		'path',
        'order_number',
	];
}
