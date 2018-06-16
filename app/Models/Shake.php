<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 22 May 2018 21:46:24 +0800.
 */

namespace App\Models;

/**
 * Class Shake
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property int $created_at
 * @property int $updated_at
 * @property int $sort
 * @property string $entry
 * @property int $interest_id
 * @property string $interest_name
 * @property string $potential_ids
 * @property string $potential_names
 * @property string $description
 *
 * @package App\Models
 */
class Shake extends Common
{
	protected $casts = [
		'status' => 'int',
		'created_at' => 'int',
		'updated_at' => 'int',
		'sort' => 'int',
		'interest_id' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'entry',
		'interest_id',
		'interest_name',
		'potential_ids',
		'potential_names',
		'description'
	];

    static protected $member_shake_potential_grades;
    static protected $member_interest_grades;


    static public function grade($member_id, $order_number)
    {
        $shakes = static::getAllIndexById();
        $shake_grades = [];

        foreach ($shakes as $shake) {
            static::updateMemberShakePotentialGrade($shake, $member_id, $order_number);
            $shake_grades[$shake['id']] = [
                'member_id' => $member_id,
                'shake_id' => $shake['id'],
                'grade' => 0,
                'weight' => $shake['sort'],
                'order_number' => $order_number,
            ];
        }
        static::$member_shake_potential_grades = MemberShakePotentialGrade::where(['member_id'=>$member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
        static::$member_interest_grades = MemberInterestGrade::where(['member_id'=>$member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
        foreach ($shakes as $shake) {

            $shake_grades[$shake['id']]['grade'] = static::gradeOne($shake, $member_id, $order_number);
        }
//        static::deleteByMemberId($member_id);
        static::deleteByOrderNumber($order_number);
        MemberShakeGrade::insert($shake_grades);
    }

    static public function updateMemberShakePotentialGrade($shake, $member_id, $order_number)
    {
        $where = [
            'member_id' => $member_id,
            'shake_id' => $shake['id'],
            'potential_ids' => $shake['potential_ids'],
            'order_number' => $order_number,
        ];
        $member_shake_potential_grade = MemberShakePotentialGrade::where($where)->first();
        if (!$member_shake_potential_grade) {
            $member_shake_potential_grade = new MemberShakePotentialGrade();
            $member_shake_potential_grade->member_id = $member_id;
            $member_shake_potential_grade->order_number = $order_number;
            $member_shake_potential_grade->shake_id = $shake['id'];
            $member_shake_potential_grade->potential_ids = $shake['potential_ids'];
            $member_shake_potential_grade->grade = static::getPotentialGrade($shake, $member_id, $order_number);
            $member_shake_potential_grade->save();
        } else {
            $data = [
                'grade' => static::getPotentialGrade($shake, $member_id, $order_number)
            ];
            $member_shake_potential_grade->where($where)->update($data);
        }


    }

    static public function gradeOne($shake, $member_id, $order_number)
    {
        $potential_grade = static::getPotentialGrade($shake, $member_id, $order_number);
        $potential_rank_grade = static::getPotentialRankGrade(static::$member_shake_potential_grades, $shake);
        $interest_rank_grade = static::getInterestRankGrade(static::$member_interest_grades, $shake);
        $grade = $potential_grade + $potential_rank_grade + $interest_rank_grade;
        $grade = round((($grade / 140) * 100), 1);
        return $grade;
    }

    static public function getPotentialGrade($shake, $member_id, $order_number)
    {
        $len = strlen($shake['potential_ids']);
        $potential_grade = 0;
        for ($i = 0; $i < $len; $i++) {
            $where = [
                'member_id' => $member_id,
                'potential_id' => $shake['potential_ids'][$i],
                'order_number' => $order_number,
            ];
            $member_potential_grade = MemberPotentialGrade::where($where)->first();
            if ($member_potential_grade) {
                $potential_grade += $member_potential_grade->grade;
            } else {
                var_dump($shake['potential_ids'][$i]);
                var_dump('没找着，潜能');
            }
        }
        $potential_grade = $potential_grade / $len;
        return $potential_grade;

    }

    static public function getPotentialRankGrade($member_shake_potential_grades, $shake)
    {
        //潜能排名后加一次分。1+10分；2+5；3+2；其他+0
        foreach ($member_shake_potential_grades as $key => $member_shake_potential_grade) {
            if ($shake['id'] == $member_shake_potential_grade->shake_id) {
                $sort = $key + 1;
                if ($sort == 1) {
                    return 10;
                } elseif ($sort == 2) {
                    return 5;
                } elseif ($sort == 3) {
                    return 2;
                }
            }
        }

        return 0;

    }

    static public function getInterestRankGrade($member_interest_grades, $shake)
    {
        //兴趣排名加分。1+10，2+10；3+8；4+2；5+1；6+0
        foreach ($member_interest_grades as $key => $member_interest_grade) {
            if ($shake['interest_id'] == $member_interest_grade->interest_id) {
                $sort = $key + 1;
                if ($sort == 1) {
                    return 10;
                } elseif ($sort == 2) {
                    return 10;
                } elseif ($sort == 3) {
                    return 8;
                } elseif ($sort == 4) {
                    return 2;
                } elseif ($sort == 5) {
                    return 1;
                }
            }
        }

        return 0;
    }

    static public function deleteByMemberId($member_id)
    {
        $items = static::all()->toArray();
        foreach ($items as $item) {
            $row = MemberShakeGrade::where(['member_id'=>$member_id,'shake_id'=>$item['id']])->first();

            if ($row) {
                $row->where(['member_id'=>$member_id,'shake_id'=>$item['id']])->delete();
            }
        }

    }

    static public function deleteByOrderNumber($order_number)
    {
        $items = static::all()->toArray();
        foreach ($items as $item) {
            $row = MemberShakeGrade::where(['order_number'=>$order_number,'shake_id'=>$item['id']])->first();

            if ($row) {
                $row->where(['order_number'=>$order_number,'shake_id'=>$item['id']])->delete();
            }
        }

    }

    static public function getGradesByMemberId($member_id, $order_number){

        return MemberShakeGrade::where(['member_id' => $member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
    }

    static public function addInterestPotentialGrade($shake_grades, $shakes, $potential_grades, $interest_grades)
    {
        $potential_grades = $potential_grades->toArray();
        $interest_grades = $interest_grades->toArray();
        $potential_id_grades = array_combine(array_column($potential_grades, 'potential_id'), array_column($potential_grades, 'grade'));
        $interest_id_grades = array_combine(array_column($interest_grades, 'interest_id'), array_column($interest_grades, 'grade'));
        if(!empty($shake_grades)) {

            foreach ($shake_grades as &$shake_grade) {
                $interest_id = $shakes[$shake_grade['shake_id']]['interest_id'];
                $shake_grade['interest_grade'] = $interest_id_grades[$interest_id];
                $potential_ids = $shakes[$shake_grade['shake_id']]['potential_ids'];
                $len = strlen($potential_ids);
                $potential_grade = 0;
                for ($i = 0; $i < $len; $i++) {
                    $potential_grade += $potential_id_grades[$potential_ids[$i]];
                }
                $shake_grade['potential_grade'] = $potential_grade / $len;

            }
        }
        return $shake_grades;

    }
}
