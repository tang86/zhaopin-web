<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // 不允许编辑字段
    protected $guarded = [];

    public function goods()
    {
        return $this->hasOne(Good::class,'id', 'goods_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
