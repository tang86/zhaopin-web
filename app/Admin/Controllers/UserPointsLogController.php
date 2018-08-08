<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserPointsLog;
use App\User;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Grid;
use App\Zack\Facades\MyAdmin as Admin;
use App\Zack\MyForm as Form;

class UserPointsLogController extends Controller
{
    protected  $title = '积分记录';

    static $STATUS = [

        2 => '兑换失败',
        1 => '兑换成功',
        0 => '兑换中',
    ];

    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header($this->title);
            $content->description(trans('admin.list'));
            $content->body($this->grid()->render());
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header($this->title);
            $content->description(trans('admin.create'));
            $content->body($this->form());
        });
    }


    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header($this->title);
            $content->description(trans('admin.edit'));
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(UserPointsLog::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->user_id('用户名')->display(function ($user_id) {
                $user = User::where('id', $user_id)->first();
                return $user->name;
            });
            $grid->remark('备注');
            $grid->points('积分');
            $grid->status('状态')->display(function ($status_id) {
                return self::$STATUS[$status_id];
            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {


            });

            $grid->tools(function (Grid\Tools $tools) {
                $tools->batch(function (Grid\Tools\BatchActions $actions) {
                    $actions->disableDelete();
                });
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Admin::form(UserPointsLog::class, function (Form $form) {
            $form->display('id', 'ID');

            $form->display('remark', '备注');
            $form->display('points', '积分');

            $form->radio('status', '状态')->values(self::$STATUS)->default(1);

            $form->disableReset();

        });
    }
}
