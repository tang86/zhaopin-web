<?php

namespace App\Http\Controllers\Home;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = '就业资讯';
        $data['active'] = 'news';

        $news = News::orderBy('sort', 'desc')
            ->orderBy('read_num', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        if(!empty($news)){
            foreach ($news as &$val) {
                $val['banner']  = url('uploads/'.$val['banner']);
                $val['hits'] = News::formatHits($val['init_read_num'] + $val['read_num']);
            }
        }
        $data['news'] = $news;
        return view('home.news', $data);
    }

    public function show(News $news)
    {
        $data = [];
        $data['title'] = '就业资讯';
        $data['active'] = 'news';

        $data['news'] = $news;


        return view('home.news-show', $data);

    }
}
