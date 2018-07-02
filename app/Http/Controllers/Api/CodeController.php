<?php

namespace App\Http\Controllers\Api;

use App\Models\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    public function create(Request $request)
    {
        $code_code = rand(1000, 9999);

        $code = new Code();
        $code->code = $code_code;
        $code->mobile = $request->get('mobile');
        $code->type_name = $request->get('type_name', '');
        $code->expired = time()+60*15;
        $code->save();

        return $this->sendResponse($code, '更新成功');
    }


}