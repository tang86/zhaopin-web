<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 15 May 2018 10:19:32 +0800.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MemberAbilityGrade
 * 
 * @property int $member_id
 * @property int $ability_id
 * @property float $grade
 * @property int $weight
 * @property int $personality_type_weight
 *
 * @package App\Models
 */
class MemberAbilityGrade extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'member_id' => 'int',
		'ability_id' => 'int',
		'grade' => 'float',
		'weight' => 'int',
        'personality_type_weight' => 'int'
	];

	protected $fillable = [
		'grade',
		'weight',
        'personality_type_weight',
        'order_number',
	];

    static public function gradeList($member_id, $order_number)
    {
        $list = [];
        $all = Ability::getAllIndexById();
        $where = [
            'member_id' => $member_id,
            'order_number' => $order_number,
        ];
        $models = static::where($where)->orderByDesc('grade')->orderByDesc('personality_type_weight')->orderByDesc('weight')->get();
        foreach ($models as $key => $model) {

            $temp = $model->toArray();
            $temp['name'] = $all[$temp['ability_id']]['name'];
            $temp['rank'] = $key + 1;
            $list[] = $temp;
        }

        return $list;
    }
}
