<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 13:58:56 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SubQuestion
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property string $title
 * @property int $question_id
 * @property int $sort
 * @property int $category_id
 * @property string $type_name
 * @property int $type_id
 *
 * @package App\Models
 */
class SubQuestion extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'int',
		'question_id' => 'int',
		'sort' => 'int',
		'category_id' => 'int',
		'type_id' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'title',
		'question_id',
		'sort',
		'category_id',
		'type_name',
		'type_id'
	];

	static public function fetchByQuestionId($id)
    {
        return static::where(['question_id' => $id])->orderBy('sort', 'ASC')->get();
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
