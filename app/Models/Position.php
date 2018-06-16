<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 16 Jun 2018 17:08:38 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Position
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property int $created_at
 * @property int $updated_at
 * @property int $sort
 * @property string $keywords
 * @property int $room_and_board
 * @property int $number
 * @property string $content
 * @property string $benefit
 *
 * @package App\Models
 */
class Position extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'created_at' => 'int',
		'updated_at' => 'int',
		'sort' => 'int',
		'room_and_board' => 'int',
		'number' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'keywords',
		'room_and_board',
		'number',
		'content',
		'benefit'
	];
}
