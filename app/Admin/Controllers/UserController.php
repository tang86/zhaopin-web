<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\AbleUser;
use App\Admin\Extensions\DisableUser;
use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('用户管理');
            $content->description('小程序用户');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
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

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('微信名');
            $grid->open_id();
            $grid->column('n', '状态')->display(function () {
                return $this->status == 1 ? '正常' : '已禁用';
            });
            $grid->inviter_id('邀请人')->display(function($inviterId) {
                if($inviterId){
                    return User::find($inviterId)->name;
                }else {
                    return '';
                }
            });
            $grid->created_at('注册时间');
            $grid->updated_at('上次修改时间');
            $grid->disableCreateButton();

            $grid->actions(function ($actions) {
                if ($actions->row->status == 1) {
                    $actions->append(new DisableUser($actions->getKey()));
                } else {
                    $actions->append(new AbleUser($actions->getKey()));
                }
                $actions->disableEdit();
            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    /**
     * 说明: 禁用
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function disable(User $user)
    {
        $user->status = 2;
        if (empty($user->save()))
            return $this->sendError('禁用失败', ['禁用失败'], 500);
        return $this->sendResponse([], '禁用成功');
    }

    /**
     * 说明: 启用
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function able(User $user)
    {
        $user->status = 1;
        if (empty($user->save()))
            return $this->sendError('禁用失败', ['启用失败'], 500);
        return $this->sendResponse([], '禁用成功');
    }
}
