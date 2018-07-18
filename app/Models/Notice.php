<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 Jun 2018 20:08:43 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Notice
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Notice extends Eloquent
{
	protected $fillable = [
		'title',
		'content'
	];
}
