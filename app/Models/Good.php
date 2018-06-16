<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    // 主键
    protected $primaryKey = 'id';

    // 不允许编辑字段
    protected $guarded = [];

    public function goodsCategories()
    {
        return $this->hasOne(GoodsCategories::class,'id', 'class_id');
    }
}
