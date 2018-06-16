<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 22 May 2018 21:45:37 +0800.
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class Potential
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $remark
 * @property int $created_at
 * @property int $updated_at
 * @property int $sort
 * @property string $description
 * @property string $shortcoming
 *
 * @package App\Models
 */
class Potential extends Common
{
	protected $casts = [
		'status' => 'int',
		'created_at' => 'int',
		'updated_at' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'remark',
		'sort',
		'description',
		'shortcoming'
	];

    static public function grade($member_id, $order_number)
    {
        //素质模型
        $potentials = static::getAllIndexById();
        $potential_grades = [];

        foreach ($potentials as $potential) {
            $potential_grades[$potential['id']] = [
                'member_id' => $member_id,
                'potential_id' => $potential['id'],
                'grade' => 0,
                'weight' => $potential['sort'],
                'order_number' => $order_number,
            ];
        }


        foreach ($potentials as $potential) {

            $potential_grades[$potential['id']]['grade'] = static::gradeOne($potential, $member_id, $order_number);
        }

        static::deleteByOrderNumber($order_number);
        MemberPotentialGrade::insert($potential_grades);

    }

    static public function gradeOne($potential, $member_id, $order_number)
    {
        $grade = 0;
        $quality_names = explode('+', $potential['remark']);
        $number = 0;
        foreach ($quality_names as $quality_name) {
            $grade += static::getQualityGrade($quality_name, $member_id, $order_number);
            $number++;
        }

        return $grade/$number;
    }

    static public function getQualityGrade($quality_name, $member_id, $order_number)
    {
        $quality_grade = 0;
        $quality = Quality::where(['name' => $quality_name])->first();
        if ($quality) {
            $where = [
                'quality_id' => $quality->id,
                'member_id' => $member_id,
                'order_number' => $order_number,
            ];
            $member_quality_grade = MemberQualityGrade::where($where)->first();

            if ($member_quality_grade) {
                $quality_grade = $member_quality_grade->grade;
            }

            return $quality_grade;

        } else {
            var_dump('无效的素质模型名称：'.$quality_name);

        }

    }

    static public function deleteByMemberId($member_id)
    {
        $items = static::all()->toArray();
        foreach ($items as $item) {
            $row = MemberPotentialGrade::where(['member_id'=>$member_id,'potential_id'=>$item['id']])->first();

            if ($row) {
                $row->where(['member_id'=>$member_id,'potential_id'=>$item['id']])->delete();
            }
        }

    }

    static public function deleteByOrderNumber($order_number)
    {
        $items = static::all()->toArray();
        foreach ($items as $item) {
            $row = MemberPotentialGrade::where(['order_number'=>$order_number,'potential_id'=>$item['id']])->first();

            if ($row) {
                $row->where(['order_number'=>$order_number,'potential_id'=>$item['id']])->delete();
            }
        }

    }

    static public function getGradesByMemberId($member_id, $order_number){

        return MemberPotentialGrade::where(['member_id' => $member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
    }

    /**
     * 根据分数划分等级
     * @param $sorted_grades
     * @return array
     */
    static public function levelGrades($sorted_grades)
    {
        $levels = [
            0 => [
                'name' => '',
                'star_img' => 'images/star_5.png',
                'description' => '这是你最强大的潜能，需要好好发挥和针对性的培养。',
            ],
            1 => [
                'name' => '',
                'star_img' => 'images/star_4.png',
                'description' => '这是你非常强大的潜能，需要多多磨练',
            ],
            2 => [
                'name' => '',
                'star_img' => 'images/star_3.png',
                'description' => '这是你一般的潜能，对你会有较大的帮助，但不具有至关重要的决定性',
            ],
            3 => [
                'name' => '',
                'star_img' => 'images/star_1.png',
                'description' => '这是你最不具备优势的领域，建议最好不要涉及该专业以及从事该类职业，因为这是你天生性格的短板，要改变自己的性格是非常困难，且需要付出非常大代价的，当你在弥补短板的时候会同时导致你最大优势的丧失，这会对你产生不好的影响——如：自信心的打击，成长速度缓慢等',
            ],

        ];
        $potentials = static::getAllIndexById();

        if (!empty($sorted_grades)) {
            foreach ($sorted_grades as $key => $sorted_grade) {
                if ($key == 0) {
                    $levels[0]['name'] .= $potentials[$sorted_grade['potential_id']]['name'];
                } elseif ($key <= 2) {
                    $levels[1]['name'] .= $potentials[$sorted_grade['potential_id']]['name'];
                    $levels[1]['name'] .= '/';

                } elseif ($key <= 6) {
                    $levels[2]['name'] .= $potentials[$sorted_grade['potential_id']]['name'];
                    $levels[2]['name'] .= '/';
                } else {
                    $levels[3]['name'] .= $potentials[$sorted_grade['potential_id']]['name'];
                    $levels[3]['name'] .= '/';
                }

            }
        }
        return $levels;
    }

    static public function getQualities($potential_id)
    {
        return PotentialHasQuality::where(['potential_id' => $potential_id])->get();

    }

    static public function getBestAbilities($member_id, $id, $order_number)
    {
        $quality_ids = [];
        $models = PotentialHasQuality::where(['potential_id' => $id])->select('quality_id')->get();
        if (!empty($models)) {
            foreach ($models as $model) {
                $quality_ids[] = $model->quality_id;
            }
        }
       DB::connection()->enableQueryLog(); // 开启查询日志


        $best_quality_grade = MemberQualityGrade::where(['member_id' => $member_id])
            ->where(['order_number' => $order_number])
            ->whereIn('quality_id',$quality_ids)
            ->orderByDesc('grade')
            ->orderByDesc('weight')
            ->first();

        $models = QualityHasAbility::where(['quality_id' => $best_quality_grade->quality_id])
            ->whereIn('type_id',[1,2,3])
            ->get();
        $sql = DB::getQueryLog();

        $ability_ids = [];
        if (!empty($models)) {
            foreach ($models as $model) {
                $ability_ids[] = $model->ability_id;
            }
        }

        $sorted_ability_grades = MemberAbilityGrade::whereIn('ability_id', $ability_ids)
            ->where(['order_number' => $order_number])
            ->orderByDesc('grade')
            ->orderByDesc('personality_type_weight')
            ->orderByDesc('weight')
            ->get();

        $abilities = Ability::whereIn('id', $ability_ids)->get();
        $abilities = Ability::modelIndexBy($abilities, 'id');

        $sorted_abilities = [];

        foreach ($sorted_ability_grades as $sorted_ability_grade) {
            $sorted_abilities[] = $abilities[$sorted_ability_grade->ability_id];
        }

        return $sorted_abilities;

    }


}
