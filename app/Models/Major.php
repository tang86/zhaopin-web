<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 May 2018 10:08:56 +0800.
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * Class Major
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property int $created_at
 * @property int $updated_at
 * @property int $sort
 * @property int $major_category_id
 * @property int $personality_id
 * @property string $personality_name
 * @property int $major_id
 * @property string $majors_name
 * @property string $potential_ids
 * @property string $potential_names
 *
 * @package App\Models
 */
class Major extends Common
{
	protected $casts = [
		'status' => 'int',
		'created_at' => 'int',
		'updated_at' => 'int',
		'sort' => 'int',
		'major_category_id' => 'int',
		'personality_id' => 'int',
		'major_id' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'major_category_id',
		'personality_id',
		'personality_name',
		'major_id',
		'shakes_name',
		'potential_ids',
		'potential_names'
	];

    static protected $member_potential_grades;
    static protected $member_shake_grades;
    static protected $member_interest_grades;

    static public function grade($member_id, $order_number)
    {
        $majors = static::getAllIndexById();
        $major_grades = [];

        foreach ($majors as $major) {
            if ($major['shake_id'] == 0) continue;//分类不要只要专业
            $major_grades[$major['id']] = [
                'member_id' => $member_id,
                'major_id' => $major['id'],
                'grade' => 0,
                'weight' => $major['sort'],
                'order_number' => $order_number,
            ];
        }

        //潜能
        static::$member_potential_grades = MemberPotentialGrade::where(['member_id'=>$member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
        static::$member_potential_grades = static::indexBy(static::$member_potential_grades, 'potential_id');
        //型格
        static::$member_shake_grades = MemberShakeGrade::where(['member_id'=>$member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
        static::$member_shake_grades = static::indexBy(static::$member_shake_grades, 'shake_id');
        //兴趣
        static::$member_interest_grades = MemberInterestGrade::where(['member_id'=>$member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
        static::$member_interest_grades = static::indexBy(static::$member_interest_grades, 'interest_id');
        foreach ($majors as $major) {
            if ($major['shake_id'] == 0) continue;//分类不要只要专业
            $major_grades[$major['id']]['grade'] = static::gradeOne($major, $member_id, $order_number);
        }

//        static::deleteByMemberId($member_id);
        static::deleteByOrderNumber($order_number);
        MemberMajorGrade::insert($major_grades);
    }


    static public function gradeOne($major, $member_id, $order_number)
    {
        //潜能第一（30分）+潜能第二（25分）+潜能第三（20分）+潜能第四（15分）+潜能第五（10分）+
        //型格第一（15分）/型格第二三（5分）+兴趣第一（10分）/兴趣第二三（5分）

        //潜能第六到第九为0分；型格第四到第六为0分；兴趣第四到第六为0分
        $grade = 0;
        $shake_sort_number = static::$member_shake_grades[$major['shake_id']]['sort'];
        $interest_sort_number = static::$member_interest_grades[$major['interest_id']]['sort'];

        $len = strlen($major['potential_ids']);
        for ($i = 0; $i < $len; $i++) {
            $potential_id = $major['potential_ids'][$i];
            $potential_sort_number = static::$member_potential_grades[$potential_id]['sort'];
            if ($potential_sort_number == 1) {
                $grade += 30;
            } elseif ($potential_sort_number == 2) {
                $grade += 25;
            } elseif ($potential_sort_number == 3) {
                $grade += 20;
            } elseif ($potential_sort_number == 4) {
                $grade += 15;
            } elseif ($potential_sort_number == 5) {
                $grade += 10;
            }
        }



        if ($shake_sort_number == 1) {
            $grade += 15;
        } elseif (in_array($shake_sort_number, [2, 3])) {
            $grade += 5;
        }

        if ($interest_sort_number == 1) {
            $grade += 10;
        } elseif (in_array($interest_sort_number, [2, 3])) {
            $grade += 5;
        }

        return $grade;
    }

    static public function deleteByMemberId($member_id)
    {
        $items = static::all()->toArray();
        foreach ($items as $item) {
            $row = MemberMajorGrade::where(['member_id'=>$member_id,'major_id'=>$item['id']])->first();

            if ($row) {
                $row->where(['member_id'=>$member_id,'major_id'=>$item['id']])->delete();
            }
        }

    }
    static public function deleteByOrderNumber($order_number)
    {
        $sql = "DELETE FROM member_major_grades WHERE order_number = '{$order_number}'";
        DB::delete($sql);
//        $items = static::all()->toArray();
//        foreach ($items as $item) {
//            $row = MemberMajorGrade::where(['order_number'=>$order_number,'major_id'=>$item['id']])->first();
//
//            if ($row) {
//                $row->where(['order_number'=>$order_number,'major_id'=>$item['id']])->delete();
//            }
//        }

    }

    static public function getGradesByMemberId($member_id, $order_number){

        return MemberMajorGrade::where(['member_id' => $member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
    }
}
