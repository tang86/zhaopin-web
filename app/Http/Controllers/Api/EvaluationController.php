<?php

namespace App\Http\Controllers\Api;

use App\Models\Answer;
use App\Models\Good;
use App\Models\MemberHasSubject;
use App\Models\Order;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function questions(Request $request)
    {
        $where = [];
        if ($request->query->get('category_id')) {
            $where['category_id'] = $request->query->get('category_id');
        }
        $questions = Question::with('subQuestions')->where($where)->get();

        return $this->sendResponse($questions, '成功');
    }

    public function answer(Request $request)
    {
        $post = $request->post();

        //记录测评每一题的答案
        $where = [
            'member_id' => $post['member_id'],
            'subject_id' => $post['subject_id'],
            'category_id' => $post['category_id'],
            'question_id' => $post['question_id'],
            'order_number' => $post['order_number'],
        ];
        $answer = Answer::firstOrCreate($where);
        $answer->selected = $post['selected'];
        $answer->save();


        //记录测试进度
        $where_member_subject = [
            'member_id' => $post['member_id'],
            'subject_id' => $post['subject_id'],
            'order_number' => $post['order_number'],
        ];
        $member_has_subject = MemberHasSubject::firstOrNew($where_member_subject);

        $member_has_subject->member_id = $answer->member_id;
        $member_has_subject->subject_id = $answer->subject_id;
        $member_has_subject->category_id = $answer->category_id;
        $member_has_subject->question_id = $answer->question_id;
        $member_has_subject->current_key = $post['current_key'];
        $member_has_subject->subject_status = 1;
        $member_has_subject->save();

        return $this->sendResponse($member_has_subject, 'success');

    }

    public function grade(Request $request)
    {
        $member_id = $request->post('member_id');
        $category_id = $request->post('category_id');
        $order_number = $request->post('order_number');


        $where_member_subject = [
            'member_id' => $member_id,
            'order_number' => $order_number,
        ];
        $member_has_subject = MemberHasSubject::firstOrNew($where_member_subject);

        switch ($category_id) {
            case 1:
                Answer::gradeCatA($member_id, $order_number); //计算兴趣
                $member_has_subject->subject_status = 1;

                break;

            case 2:
                Answer::gradeCatB($member_id, $order_number); //才干 能力 得分
                $member_has_subject->subject_status = 1;
                break;

            case 3:
                Answer::gradeCatC($member_id, $order_number); // 性格得分
                Answer::gradeQuality($member_id, $order_number); //素质模型
                Answer::gradePotential($member_id, $order_number); //计算潜能
                Answer::gradeShake($member_id, $order_number); //计算型格
                Answer::gradeMajor($member_id, $order_number); //计算专业

                $member_has_subject->subject_status = 2;

                break;
        }
        $member_has_subject->save();

    }

    public function history(Request $request)
    {
        $post = $request->post();

        $where = [
            'member_id' => $post['member_id'],
            'subject_id' => $post['subject_id'],
            'order_number' => $post['order_number'],
        ];

        $history = MemberHasSubject::firstOrCreate($where);

        return $this->sendResponse($history, 'success');

    }

    public function histories(Request $request)
    {
        $post = $request->post();

        $member_has_subjects = MemberHasSubject::where(['member_id' => $post['member_id']])->get();
        if ($member_has_subjects) {
            $member_has_subjects = MemberHasSubject::indexByOrderNumber($member_has_subjects);
        }


        $where = [
            'user_id' => $post['member_id'],
        ];
        $histories = [
            'finished' => [],
            'unfinished' => []
        ];
        $orders = Order::where($where)->Where(['order_status' => 1])->orderBy('id','desc')->get();
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $goods = Good::where(['id' => $order->goods_id])->first();
                $history = [];
                $history['title'] = $goods->goods_name;
                $history['payPrice'] = $order->paid_price;
                $history['price'] = $goods->price;
                $history['payDate'] = $order->created_at->format('Y-m-d H:i');
                $history['orderNo'] = $order->order_id;
                $history['id'] = $order->id;
                $history['goods_id'] = $order->goods_id;
                $history['class_id'] = $order->class_id;
                $history['subject_status'] = $member_has_subjects[$order->order_id]['subject_status']??0;

                $history['last'] = '';
                if (isset($member_has_subjects[$order->order_id])) {

                    $current_no = $member_has_subjects[$order->order_id]['current_key'] + 1;
                    if ($member_has_subjects[$order->order_id]['category_id'] == 1) {
                        $history['last'] = "上次测到：B类 {$current_no}题";
                    } elseif($member_has_subjects[$order->order_id]['category_id'] == 2) {
                        $history['last'] = "上次测到：A类 {$current_no}题";
                    }  elseif($member_has_subjects[$order->order_id]['category_id'] == 3) {
                        $history['last'] = "上次测到：C类 {$current_no}题";
                    } else {
                        $history['last'] = '';
                    }

                }


                if ($history['subject_status'] == 2) {
                    $histories['finished'][] = $history;
                } else {
                    $histories['unfinished'][] = $history;
                }


            }
        }

        return $this->sendResponse($histories, 'success');

    }
}
