<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * 说明: 返回随机数据
     *
     * @param Faker $faker
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function randOrder(Faker $faker)
    {
        $name = str_limit($faker->name,8);
        $result = $faker->randomElement(['完成了', '购买了']);
        $data = $faker->randomElement(['高中生专业选择测评', '专家一对一咨询']);
        $res = $name . '刚' . $result . $data;
        return $this->sendResponse($res, $res);
    }
}
