<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponsRelUser extends Model
{
    // 不允许编辑字段
    protected $guarded = [];

    /**
     * 说明: 优惠券具体信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author 郭庆
     */
    public function coupon()
    {
        return $this->hasOne(Coupon::class, 'id', 'coupon_id');
    }

    /**
     * 说明: 优惠券有效期-开始时间
     *
     * @return false|string
     * @author 郭庆
     */
    public function getExpireStartCnAttribute()
    {
        return date('Y-m-d', $this->coupon->expire_start);
    }

    /**
     * 说明: 优惠券有效期-结束时间
     *
     * @return false|string
     * @author 郭庆
     */
    public function getExpireEndCnAttribute()
    {
        return date('Y-m-d', $this->coupon->expire_end);
    }

    /**
     * 说明: 优惠券状态
     *
     * @return bool
     * @author 郭庆
     */
    public function getStatusCnAttribute()
    {
        if (empty($this->status) || $this->coupon->expire_end < strtotime(date('Y-m-d', time()))) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 说明: 返回给前端的字段
     *
     * @param CouponsRelUser $item
     * @return array
     * @author 郭庆
     */
    public static function getItems(self $item)
    {
        return [
            'id' => $item->id,
            'coupon_id' => $item->coupon_id,
            'user_id' => $item->user_id,
            'price' => $item->price,
            'expire_start' => $item->expire_start_cn,
            'expire_end' => $item->expire_end_cn,
            'remark' => $item->coupon->remark??null,
            'status' => $item->status_cn,
            'status_cn' => $item->status,
        ];
    }
}
