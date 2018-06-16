<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 22 May 2018 21:54:10 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MemberPotentialGrade
 * 
 * @property int $member_id
 * @property int $potential_id
 * @property float $grade
 * @property int $weight
 *
 * @package App\Models
 */
class MemberPotentialGrade extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'member_id' => 'int',
		'potential_id' => 'int',
		'grade' => 'float',
		'weight' => 'int'
	];

	protected $fillable = [
		'grade',
		'weight',
        'order_number',
	];

    static public function gradeList($member_id, $order_number)
    {
        $list = [];
        $all = Potential::getAllIndexById();
        $where = [
            'member_id' => $member_id,
            'order_number' => $order_number,
        ];
        $models = static::where($where)->orderByDesc('grade')->orderByDesc('weight')->get();
        foreach ($models as $key => $model) {

            $temp = $model->toArray();
            $temp['name'] = $all[$temp['potential_id']]['name'];
            $temp['rank'] = $key + 1;
            $list[] = $temp;
        }

        return $list;
    }
}
