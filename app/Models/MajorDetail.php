<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 22 May 2018 21:43:52 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MajorDetail
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $goal
 * @property string $course
 * @property string $career
 * @property int $major_id
 * @property int $status
 * @property string $remark
 * @property int $created_at
 * @property int $updated_at
 * @property int $sort
 *
 * @package App\Models
 */
class MajorDetail extends Eloquent
{
	protected $casts = [
		'major_id' => 'int',
		'status' => 'int',
		'created_at' => 'int',
		'updated_at' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'code',
		'name',
		'description',
		'goal',
		'course',
		'career',
		'major_id',
		'status',
		'remark',
		'sort'
	];

    static public function getAllIndexById()
    {
        $items = [];
        $models = static::all();
        foreach ($models as $model) {
            $items[$model->id] = $model->toArray();
        }
        return $items;

    }

    static public function getAllIndexByMajorId()
    {
        $items = [];
        $models = static::all();
        foreach ($models as $model) {
            $items[$model->major_id] = $model->toArray();
        }
        return $items;

    }
}
