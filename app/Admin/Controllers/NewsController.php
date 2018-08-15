<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
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

            $content->header('新闻管理');
            $content->description('新闻列表');

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

            $content->header('新闻管理');
            $content->description('编辑新闻');

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

            $content->header('新闻管理');
            $content->description('添加新闻');

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
        return Admin::grid(News::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('标题');
            $grid->brief('简述');
            $grid->banner('缩略图')->display(function ($banner) {
                return "<img src=".config('APP_URL').'/uploads/'.$banner." width=100 >";
            });
            $grid->keyword('关键字');
            $grid->banner_status('是否上轮播')->display(function ($status) {
                return $status ? '是' : '否';
            });
            $grid->like_num('点赞量');
            $grid->read_num('阅读量');

            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(News::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title','标题')->rules('required|max:20');
            $form->textarea('brief','简述')->rules('required|max:40');
            $form->text('keyword','关键字')->rules('required|max:48');
            $form->image('banner','缩略图')->uniqueName()->move('news');

            $form->editor('content','内容')->rules('required');
            $form->number('like_num', '点赞量')->default(0);
            $form->number('read_num', '阅读量')->default(0);
            $form->switch('banner_status', '是否上轮播？');
            $form->number('sort', '排序')->default(0);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function uploadNews(Request $request)
    {
        $path = Storage::disk('local')->putFile('news', $request->file('img'));
        $p = '/uploads/'.$path;
        return response()->json(['errno'=>0,'data'=>[$p]]);
    }
}
