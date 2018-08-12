<?php

namespace App\Http\Controllers\Home;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = '首页';
        $data['active'] = 'home';

        $where = [];
        $where['banner_status'] = 1;
        $page_size = 3;
        $banners = News::where($where)
            ->orderBy('sort', 'desc')
            ->orderBy('read_num', 'desc')
            ->orderBy('id', 'desc')
            ->paginate($page_size);

        if(!empty($banners)){
            foreach ($banners as &$val) {
                $val['banner']  = url('uploads/'.$val['banner']);

                $val['hits'] = News::formatHits($val['init_read_num'] + $val['read_num']);
            }

        }
        $data['banners'] = $banners;

        return view('home.index', $data);
    }
}
