<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 15 May 2018 10:21:29 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MemberQualityGrade
 * 
 * @property int $member_id
 * @property int $quality_id
 * @property float $grade
 * @property int $weight
 *
 * @package App\Models
 */
class MemberQualityGrade extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'member_id' => 'int',
		'quality_id' => 'int',
		'grade' => 'float',
		'weight' => 'int',
        'order_number',
	];

	protected $fillable = [
		'grade',
		'weight'
	];

    static public function gradeList($member_id, $order_number)
    {
        $list = [];
        $all = Quality::getAllIndexById();
        $where = [
            'member_id' => $member_id,
            'order_number' => $order_number,
        ];
        $models = static::where($where)->orderByDesc('grade')->orderByDesc('weight')->get();
        foreach ($models as $key => $model) {

            $temp = $model->toArray();
            $temp['name'] = $all[$temp['quality_id']]['name'];
            $temp['rank'] = $key + 1;
            $list[] = $temp;
        }

        return $list;
    }
}
