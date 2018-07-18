<?php

namespace App\Http\Controllers\Home;

use App\Models\Answer;
use App\Models\Interest;
use App\Models\Major;
use App\Models\MajorDetail;
use App\Models\MemberAbilityGrade;
use App\Models\MemberInterestGrade;
use App\Models\MemberMajorGrade;
use App\Models\MemberPersonalityGrade;
use App\Models\MemberPotentialGrade;
use App\Models\MemberQualityGrade;
use App\Models\MemberShakeGrade;
use App\Models\Potential;
use App\Models\Quality;
use App\Models\Report;
use App\Models\Shake;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvaluationController extends Controller
{
    public function index()
    {
        return view('evaluation.index');
    }

    public function reports()
    {
        $data = [];
        $reports = Report::all();
        $data['reports'] = $reports;
        return view('evaluation.reports',$data);
    }

    public function gradeDetail($member_id, $order_number)
    {
        $data = [];

        Answer::gradeCatA($member_id, $order_number); //计算兴趣
        $interest_grades = MemberInterestGrade::gradeList($member_id, $order_number);
        $data['interest_grades'] = $interest_grades;

        Answer::gradeCatB($member_id, $order_number); //才干 能力 得分
        $ability_grades = MemberAbilityGrade::gradeList($member_id, $order_number);
        $data['ability_grades'] = $ability_grades;

        Answer::gradeCatC($member_id, $order_number); // 性格得分
        $personality_grades = MemberPersonalityGrade::gradeList($member_id, $order_number);
        $data['personality_grades'] = $personality_grades;

        Answer::gradeQuality($member_id, $order_number); //素质模型
        $quality_grades = MemberQualityGrade::gradeList($member_id, $order_number);
        $data['quality_grades'] = $quality_grades;

        Answer::gradePotential($member_id, $order_number); //计算潜能
        $potential_grades = MemberPotentialGrade::gradeList($member_id, $order_number);
        $data['potential_grades'] = $potential_grades;

        Answer::gradeShake($member_id, $order_number); //计算型格
        $shake_grades = MemberShakeGrade::gradeList($member_id, $order_number);
        $data['shake_grades'] = $shake_grades;

        Answer::gradeMajor($member_id, $order_number); //计算专业
        $major_grades = MemberMajorGrade::gradeList($member_id, $order_number);
        $data['major_grades'] = $major_grades;
        return view('evaluation.grade-detail', $data);

    }


    public function report(Request $request,$member_id)
    {
        $data = [];
        $order_number = $request->query->get('order_number');
        $where = [
            'order_number' => $order_number,
        ];
        //测评报告
        $report = Report::where($where)->first();

        if (!empty($report)) {
            if (!empty($report->path) && file_exists(base_path('public'.'/'.$report->path))) {
               return file_get_contents(base_path('public'.'/'.$report->path));
            }
        } else {
            exit('没有相关数据');
        }

        $report->created_at = time();
        $data['report'] = $report;

        //潜能
        $potentials = Potential::getAllIndexById();
        $data['potentials'] = $potentials;
        //兴趣
        $interests = Interest::getAllIndexById();
        $data['interests'] = $interests;
        //型格
        $shakes = Shake::getAllIndexById();
        $data['shakes'] = $shakes;
        //素质
        $qualities = Quality::orderBy('sort', 'DESC')->get();
        $data['qualities'] = $qualities;
        //专业
        $majors = Major::getAllIndexById();
        $data['majors'] = $majors;
        //专业详情
        $major_details = MajorDetail::getAllIndexByMajorId();
        $data['major_details'] = $major_details;

        //潜能得分
        $potential_grades = Potential::getGradesByMemberId($member_id, $order_number);
        $data['potential_grades'] = $potential_grades;
        $level_grades = Potential::levelGrades($potential_grades);
        $data['level_grades'] = $level_grades;

        //素质模型得分
        $quality_grades = Quality::getGradesByMemberId($member_id, $order_number);
        $data['quality_grades'] = $quality_grades;

        //兴趣得分
        $interest_grades = Interest::getGradesByMemberId($member_id, $order_number);
        $data['interest_grades'] = $interest_grades;

        //型格得分
        $shake_grades = Shake::getGradesByMemberId($member_id, $order_number)->toArray();
        $shake_grades = Shake::addInterestPotentialGrade($shake_grades, $shakes, $potential_grades, $interest_grades);
        $data['shake_grades'] = $shake_grades;

        //专业得分
        $major_grades = Major::getGradesByMemberId($member_id, $order_number);
        $data['major_grades'] = $major_grades;

        //最佳潜能对应素质模型
        $best_potential_has_qualities = Potential::getQualities($potential_grades[0]['potential_id']);
        $best_potential_has_qualities = Potential::indexBy($best_potential_has_qualities, 'quality_id');
        $data['best_potential_has_qualities'] = $best_potential_has_qualities;
        $best_potential_quality_ids = array_keys($best_potential_has_qualities);

        //最佳潜能对应素质模型
        $best_potential_sorted_quality_grades = [];
        foreach ($quality_grades as $quality_grade) {
            if (in_array($quality_grade->quality_id, $best_potential_quality_ids)) {
                $best_potential_sorted_quality_grades[] = [
                    'quality_id' => $quality_grade['quality_id'],
                    'quality_grade' => $quality_grade['grade']
                ];
            }
        }
        $data['best_potential_sorted_quality_grades'] = $best_potential_sorted_quality_grades;
        //最佳潜能对应的行为模式
        //潜能对应的素质模型第一 对应的第一类才干能力
        $best_potential_abilities = Potential::getBestAbilities($member_id, $potential_grades[0]->potential_id, $order_number);
        $data['best_potential_abilities'] = $best_potential_abilities;

        //第二潜能对应素质模型
        $second_potential_has_qualities = Potential::getQualities($potential_grades[1]['potential_id']);
        $second_potential_has_qualities = Potential::indexBy($second_potential_has_qualities, 'quality_id');
        $data['second_potential_has_qualities'] = $second_potential_has_qualities;
        $second_potential_quality_ids = array_keys($second_potential_has_qualities);

        //第二潜能对应素质模型
        $second_potential_sorted_quality_grades = [];
        foreach ($quality_grades as $quality_grade) {
            if (in_array($quality_grade->quality_id, $second_potential_quality_ids)) {
                $second_potential_sorted_quality_grades[] = [
                    'quality_id' => $quality_grade['quality_id'],
                    'quality_grade' => $quality_grade['grade']
                ];
            }
        }
        $data['second_potential_sorted_quality_grades'] = $second_potential_sorted_quality_grades;
        //第二潜能对应的行为模式
        //潜能对应的素质模型第一 对应的第一类才干能力
        $second_potential_abilities = Potential::getBestAbilities($member_id, $potential_grades[1]->potential_id, $order_number);
        $data['second_potential_abilities'] = $second_potential_abilities;

        //第三潜能对应素质模型
        $third_potential_has_qualities = Potential::getQualities($potential_grades[2]['potential_id']);
        $third_potential_has_qualities = Potential::indexBy($third_potential_has_qualities, 'quality_id');
        $data['third_potential_has_qualities'] = $third_potential_has_qualities;
        $third_potential_quality_ids = array_keys($third_potential_has_qualities);

        //第三潜能对应素质模型
        $third_potential_sorted_quality_grades = [];
        foreach ($quality_grades as $quality_grade) {
            if (in_array($quality_grade->quality_id, $third_potential_quality_ids)) {
                $third_potential_sorted_quality_grades[] = [
                    'quality_id' => $quality_grade['quality_id'],
                    'quality_grade' => $quality_grade['grade']
                ];
            }
        }
        $data['third_potential_sorted_quality_grades'] = $third_potential_sorted_quality_grades;

        //短板第一潜能对应素质模型
        $short_first_potential_has_qualities = Potential::getQualities($potential_grades[8]['potential_id']);
        $short_first_potential_has_qualities = Potential::indexBy($short_first_potential_has_qualities, 'quality_id');
        $data['short_first_potential_has_qualities'] = $short_first_potential_has_qualities;
        $short_first_potential_quality_ids = array_keys($short_first_potential_has_qualities);
        //短板第一潜能对应素质模型
        $short_first_potential_sorted_quality_grades = [];
        foreach ($quality_grades as $quality_grade) {
            if (in_array($quality_grade->quality_id, $short_first_potential_quality_ids)) {
                $short_first_potential_sorted_quality_grades[] = [
                    'quality_id' => $quality_grade['quality_id'],
                    'quality_grade' => $quality_grade['grade']
                ];
            }
        }
        $data['short_first_potential_sorted_quality_grades'] = $short_first_potential_sorted_quality_grades;

        //短板第二潜能对应素质模型
        $short_second_potential_has_qualities = Potential::getQualities($potential_grades[7]['potential_id']);
        $short_second_potential_has_qualities = Potential::indexBy($short_second_potential_has_qualities, 'quality_id');
        $data['short_second_potential_has_qualities'] = $short_second_potential_has_qualities;
        $short_second_potential_quality_ids = array_keys($short_second_potential_has_qualities);
        //短板第二潜能对应素质模型
        $short_second_potential_sorted_quality_grades = [];
        foreach ($quality_grades as $quality_grade) {
            if (in_array($quality_grade->quality_id, $short_second_potential_quality_ids)) {
                $short_second_potential_sorted_quality_grades[] = [
                    'quality_id' => $quality_grade['quality_id'],
                    'quality_grade' => $quality_grade['grade']
                ];
            }
        }
        $data['short_second_potential_sorted_quality_grades'] = $short_second_potential_sorted_quality_grades;


        //潜能js数据
        //行为模式
        $html = view('evaluation.report',$data)->__toString();

        $report_dir = base_path('public').'/report';
        if (!is_dir($report_dir)) {
            mkdir($report_dir);
        }

        $report_path = $report_dir.'/'.md5($member_id.$order_number).'.html';
        $report_url = 'report/'.md5($member_id.$order_number).'.html';

        file_put_contents($report_path,$html);

        $report->subject_id = 1;
        $report->member_id = $member_id;
        $report->path = $report_url;
        $report->order_number = $order_number;
        $report->save();
        return $html;


    }
}
