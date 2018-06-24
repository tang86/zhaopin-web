<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanySize;
use App\Models\Intention;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Grid;
use App\Zack\Facades\MyAdmin as Admin;
use App\Zack\MyForm as Form;

class IntentionController extends Controller
{

    protected  $title = '求职意向';

    static $STATUS = [

        1 => '开启',
        0 => '关闭',
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
        return Admin::grid(Intention::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->name('名称');
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

        return Admin::form(Intention::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('name', '名称')->rules('required');
            $form->text('sort', '排序')->default(0);
            $form->radio('status', '状态')->values(self::$STATUS)->default(1);

            $form->disableReset();

        });
    }

}