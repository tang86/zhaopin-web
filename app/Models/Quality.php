<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Apr 2018 09:52:26 +0800.
 */

namespace App\Models;

/**
 * Class Quality
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $sort
 *
 * @package App\Models
 */
class Quality extends Common
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'sort'
	];

    /**
     * 素质模型计分分类
     * 键名 为 type_id
     * 键值 为 系数
     * @var array
     */
    static public $TYPES = [
        1 => 1, //一类
        2 =>  0.5,//二类
        3 =>  0.2, //三类
        4 =>  (-0.5),//四类
    ];
    /**
     * 键名 才干排名
     * 键值 素质得分
     * @var array
     */
	static public $GRADES = [
	    1 => 5,
	    2 => 5,
	    3 => 5,
	    4 => 5,
	    5 => 5,
	    6 => 5,

        7 => 3,
        8 => 3,
        9 => 3,
        10 => 3,
        11 => 3,
        12 => 3,
        13 => 3,
        14 => 3,
        15 => 3,

        16 => 1,
        17 => 1,
        18 => 1,
        19 => 1,
        20 => 1,
        21 => 1,
        22 => 1,
        23 => 1,
        24 => 1,

        25 => (-3),
        26 => (-3),
        27 => (-3),
        28 => (-3),
        29 => (-3),
        30 => (-3),
        31 => (-3),
        32 => (-3),
        33 => (-3),
        34 => (-3),

    ];

	static public function grade($member_id, $order_number)
    {
        //素质模型
        $qualities = static::getAllIndexById();
        $quality_grades = [];

        foreach ($qualities as $quality) {
            $quality_grades[$quality['id']] = [
                'member_id' => $member_id,
                'quality_id' => $quality['id'],
                'grade' => 0,
                'weight' => $quality['sort'],
                'order_number' => $order_number,
            ];
        }
        //风格类型
        $personality_type = Personality::getType($member_id, $order_number);
        //在排名前增加权重
        Ability::addPersonalityTypeWeight($personality_type, $member_id, $order_number);
        //才干排名
        $abilities = Ability::getAllWithSort($member_id, $order_number);

        //风格排名
        foreach ($qualities as $quality) {

        //$personality_ids = array_keys($personality_type);
            $ratio = static::getRatio($personality_type, $quality['id']);
            $quality_grades[$quality['id']]['grade'] = static::gradeOne($quality, $abilities, $personality_type) * $ratio;

        }

//        static::deleteByMemberId($member_id);
        static::deleteByOrderNumber($order_number);

        MemberQualityGrade::insert($quality_grades);
    }

    static public function getRatio($personality_type, $quality_id)
    {
        $ratio = 1;
        $items = QualityHasPersonality::where(['quality_id'=>$quality_id])->get();
        foreach ($items as $item) {
            $len = strlen($item['type_name']);
            $temp = [];
            for ($i = 0; $i < $len; $i++) {
                $temp[] = $item['type_name'][$i];
            }
            if (count(array_intersect($temp, $personality_type)) == $len) {
                return $item['ratio'];
            }
        }

        return $ratio;
    }

    static public function getAllIndexById()
    {
        $items = [];
        $models = static::all();
        foreach ($models as $model) {
            $items[$model->id] = $model->toArray();
        }
        return $items;

    }

    static public function gradeOne($quality, $abilities)
    {
        $grade = 0;
        $items = QualityHasAbility::where(['quality_id' => $quality['id']])->get()->toArray();
        if (!empty($items)) {
            foreach ($items as $item) {
                $ability_srot = $abilities[$item['ability_id']]['sort'];

                $grade += static::$GRADES[$ability_srot] * static::$TYPES[$item['type_id']];
            }
            $grade = round((($grade-$quality['min'])/($quality['max']-$quality['min']))*100,1);
        }
        return $grade;
    }

    static public function deleteByMemberId($member_id)
    {
        $items = static::all()->toArray();
        foreach ($items as $item) {
            $row = MemberQualityGrade::where(['member_id'=>$member_id,'quality_id'=>$item['id']])->first();

            if ($row) {
                $row->where(['member_id'=>$member_id,'quality_id'=>$item['id']])->delete();
            }
        }

    }

    static public function deleteByOrderNumber($order_number)
    {
        $items = static::all()->toArray();
        foreach ($items as $item) {
            $row = MemberQualityGrade::where(['order_number'=>$order_number,'quality_id'=>$item['id']])->first();

            if ($row) {
                $row->where(['order_number'=>$order_number,'quality_id'=>$item['id']])->delete();
            }
        }

    }

    static public function getGradesByMemberId($member_id, $order_number){

        return MemberQualityGrade::where(['member_id' => $member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
    }

    /**
     * 素质模型在100以上的用：超强的
    素质模型在80以上的用：特别强的
    素质模型在70以上的用：很强的
    素质模型在60以上的用：不错的
    60分以上的有几个就按分数顺序描述几个
     * @param $grade
     * @return string
     */
    static public function getPrefix($grade)
    {
        $prefix = '';
        if ($grade > 100) {
            $prefix = '超强的';
        } elseif ($grade > 80) {
            $prefix = '特别强的';
        }elseif ($grade > 70) {
            $prefix = '很强的';
        }elseif ($grade > 60) {
            $prefix = '不错的';
        }
        return $prefix;
    }
}
