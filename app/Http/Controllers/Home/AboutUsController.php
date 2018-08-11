<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = '关于我们';
        $data['active'] = 'about-us';
        return view('home.about-us', $data);
    }
}
