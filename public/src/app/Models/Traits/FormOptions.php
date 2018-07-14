<?php
/**
 * Created by PhpStorm.
 * User: zhaochang
 * Date: 18-6-22
 * Time: 下午3:28
 */

namespace App\Models\Traits;

trait FormOptions
{
    static public function options()
    {
        return static::all()->sortBy('sort')->pluck('name','id');
    }
}