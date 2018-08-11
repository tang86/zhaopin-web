<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = '职位';
        $data['active'] = 'positions';
        return view('home.positions', $data);
    }
}
