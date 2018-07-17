<?php
/**
 * Created by PhpStorm.
 * User: zhaochang
 * Date: 18-4-26
 * Time: 下午7:02
 */

namespace App\Zack;


use Encore\Admin\Admin;
use App\Zack\MyForm as Form;
use Closure;
/**
 * Class MyAdmin
 * @package App\Zack
 */
class MyAdmin extends Admin
{
    /**
     * @param $model
     * @param Closure $callable
     * @return MyForm|\Encore\Admin\Form
     */
    public function form($model, Closure $callable)
    {
        return new Form($this->getModel($model), $callable);
    }
}