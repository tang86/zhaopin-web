<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 22 May 2018 21:43:22 +0800.
 */

namespace App\Models;

/**
 * Class Interest
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $initial
 * @property string $brief
 * @property string $detail
 * @property int $sort
 * @property string $career
 *
 * @package App\Models
 */
class Interest extends Common
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'int',
		'sort' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'initial',
		'brief',
		'detail',
		'sort',
		'career'
	];

    static public function deleteByMemberId($member_id)
    {
        $interests = static::all()->toArray();
        foreach ($interests as $interest) {
            $row = MemberInterestGrade::where(['member_id'=>$member_id,'interest_id'=>$interest['id']])->first();

            if ($row) {
                $row->where(['member_id'=>$member_id,'interest_id'=>$interest['id']])->delete();
            }
        }

    }

    static public function deleteByOrderNumber($order_number)
    {
        $interests = static::all()->toArray();
        foreach ($interests as $interest) {
            $row = MemberInterestGrade::where(['order_number'=>$order_number,'interest_id'=>$interest['id']])->first();

            if ($row) {
                $row->where(['order_number'=>$order_number,'interest_id'=>$interest['id']])->delete();
            }
        }

    }

    static public function getGradesByMemberId($member_id, $order_number){

        return MemberInterestGrade::where(['member_id' => $member_id])
            ->where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
    }

    static public function getGradesByOrderNumber($order_number){

        return MemberInterestGrade::where(['order_number' => $order_number])
            ->orderBy('grade', 'DESC')
            ->orderBy('weight', 'DESC')
            ->get();
    }
}
