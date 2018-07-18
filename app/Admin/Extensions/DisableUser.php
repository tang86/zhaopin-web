<?php
/**
 * Created by PhpStorm.
 * User: 郭庆
 * Date: 2018/4/29
 * Time: 下午7:31
 */

namespace App\Admin\Extensions;


use Encore\Admin\Admin;

class DisableUser
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected function script()
    {
        return <<<SCRIPT

$('.disable').on('click', function () {
    var id = $(this).data('id');
    swal({
        title: '确定禁用吗？',
        text: '',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: '确认',
        cancelButtonText: "取消",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: '/admin/users_disable/'+id,
                success: function (data) {
                        swal({
                            title: '成功！',
                            text: "禁用成功",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: '确认',
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            window.location.reload();
                        });

                },
                error: function (e) {
                    swal({
                            title: '失败！',
                            text: e.message,
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: '确认',
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            window.location.reload();
                        });
                }
            });
        } else {
            swal("取消", '已取消', "error");
        }
    });

});

SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());

        return "<a class='fa fa-ban disable' data-id='{$this->id}'></a>";
    }

    public function __toString()
    {
        return $this->render();
    }
}