<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = '首页';
        return view('home.index', $data);
    }
}
