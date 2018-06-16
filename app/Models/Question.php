<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Apr 2018 09:52:26 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Question
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property string $title
 * @property int $category_id
 * @property int $sort
 *
 * @package App\Models
 */
class Question extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'int',
		'category_id' => 'int',
		'subject_id' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'title',
		'category_id',
		'subject_id',
		'sort'
	];

	public function subQuestions()
    {
        return $this->hasMany('App\Models\SubQuestion');
    }
}
