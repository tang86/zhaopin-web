<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 22 May 2018 21:39:46 +0800.
 */

namespace App\Models;

/**
 * Class Ability
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $sort
 * @property int $number
 * @property string $description
 *
 * @package App\Models
 */
class Ability extends Common
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'int',
		'sort' => 'int',
		'number' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'sort',
		'number',
		'description'
	];

	static protected $personality_type_abilities = [
        //SP  沟通、竞争、统率、完美、取悦、行动、自信、追求
        'SP' => '沟通、竞争、统率、完美、取悦、行动、自信、追求',
        //SJ   成就、统筹、信仰、专注、责任、排难、公平、审慎、纪律
        'SJ' => '成就、统筹、信仰、专注、责任、排难、公平、审慎、纪律',
        //NF  体谅、和谐、包容、个别、积极、交往、关联、适应、伯乐
        'NF' =>'体谅、和谐、包容、个别、积极、交往、关联、适应、伯乐',
        //NT  思维、分析、战略、搜集、前瞻、回顾、学习、理念
        'NT' => '思维、分析、战略、搜集、前瞻、回顾、学习、理念',
    ];

    static public function deleteByMemberId($member_id)
    {
        $items = static::all()->toArray();
        foreach ($items as $item) {
            $row = MemberAbilityGrade::where(['member_id'=>$member_id,'ability_id'=>$item['id']])->first();

            if ($row) {
                $row->where(['member_id'=>$member_id,'ability_id'=>$item['id']])->delete();
            }
        }

    }

    static public function deleteByOrderNumber($order_number)
    {
        $items = static::all()->toArray();
        foreach ($items as $item) {
            $row = MemberAbilityGrade::where(['order_number'=>$order_number,'ability_id'=>$item['id']])->first();

            if ($row) {
                $row->where(['order_number'=>$order_number,'ability_id'=>$item['id']])->delete();
            }
        }

    }

    static public function getAllWithSort($member_id, $order_number)
    {
        $items = [];
        $grades = MemberAbilityGrade::where(['member_id'=>$member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('personality_type_weight', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get()->toArray();
        $abilities = static::getAllIndexById();
        foreach ($grades as $key => $grade) {
            $item = [];
            $item['grade'] = $grade['grade'];
            $item['sort'] = $key + 1;
            $item['name'] = $abilities[$grade['ability_id']]['name'];
            $item['ability_id'] = $grade['ability_id'];
            $item['member_id'] = $member_id;
            $item['order_number'] = $order_number;
            $items[$grade['ability_id']] = $item;
        }

        return $items;
    }

    static public function getAllIndexById()
    {
        $data = [];
        $abilities = static::all();
        foreach ($abilities as $ability) {
            $data[$ability->id] = $ability->toArray();
        }
        return $data;

    }

    /**
     * 根据风格类型为能力增加权重
     * @param $personality_type
     * @param $member_id
     * @param $order_number
     */
    static public function addPersonalityTypeWeight($personality_type, $member_id, $order_number)
    {
        $key = static::getPersonalityType($personality_type);
        $weight_abilities = explode('、', static::$personality_type_abilities[$key]);
        $abilities = static::all();
        foreach ($abilities as $ability) {
            if (in_array($ability->name,$weight_abilities)) {

                $where = [
                    'member_id' => $member_id,
                    'ability_id' => $ability->id,
                    'order_number' => $order_number,
                ];
                $member_ability_grade = MemberAbilityGrade::where($where)->first();
                if ($member_ability_grade) {

                    $member_ability_grade->where($where)->update(['personality_type_weight' => 1]);
                } else {
                    var_dump('没有这个才干分数');
                }
            }
        }


    }

    static public function getPersonalityType($personality_type)
    {
        $types = array_keys(static::$personality_type_abilities);
        foreach ($types as $type) {
            $len = strlen($type);
            $current_type = [];
            for ($i = 0; $i < $len; $i++) {
                $current_type[] = $type[$i];
            }
            $intersect = array_intersect($current_type, $personality_type);
            if (is_array($intersect) && (count($intersect) == $len)) {
                return $type;
            }
        }

        return false;
    }
}
