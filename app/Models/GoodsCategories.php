<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsCategories extends Model
{
    protected  $table = 'goodsCategories';
    // 主键
    protected $primaryKey = 'id';

    // 不允许编辑字段
    protected $guarded = [];

}
