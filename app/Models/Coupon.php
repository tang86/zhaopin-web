<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    // 主键
    protected $primaryKey = 'guid';

    // 主键类型
    protected $keyType = 'string';

    // 不允许编辑字段
    protected $guarded = [];
}
