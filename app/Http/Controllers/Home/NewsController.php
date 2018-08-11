<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = '就业资讯';
        $data['active'] = 'news';
        return view('home.news', $data);
    }

    public function show()
    {
        $data = [];
        $data['title'] = '就业资讯';
        $data['active'] = 'news';
        return view('home.news-show', $data);

    }
}
