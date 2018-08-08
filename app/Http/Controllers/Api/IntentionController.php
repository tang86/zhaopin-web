<?php

namespace App\Http\Controllers\Api;

use App\Models\Intention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntentionController extends Controller
{
    public function index()
    {
        $intentions = Intention::all()->pluck('name');

        return $this->sendResponse($intentions, '查询成功');
    }
}
