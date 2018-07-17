<?php
/**
 * Created by PhpStorm.
 * User: zhaochang
 * Date: 18-4-26
 * Time: 下午7:00
 */

namespace App\Zack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MyAdmin.
 *
 * @method static \Encore\Admin\Grid grid($model, \Closure $callable)
 * @method static \App\Zack\MyForm form($model, \Closure $callable)
 * @method static \Encore\Admin\Tree tree($model, \Closure $callable = null)
 * @method static \Encore\Admin\Layout\Content content(\Closure $callable = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void css($css = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void js($js = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void script($script = '')
 * @method static \Illuminate\Contracts\Auth\Authenticatable|null user()
 * @method static string title()
 * @method static void navbar(\Closure $builder = null)
 * @method static void registerAuthRoutes()
 * @method static void extend($name, $class)
 */
class MyAdmin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Zack\MyAdmin::class;
    }
}