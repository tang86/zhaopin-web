<?php

namespace App\Http\Controllers\Api;

use App\Models\Code;
use App\Models\User;
use App\Services\AliyunService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    public function create(Request $request)
    {
        $code_code = rand(1000, 9999);

        $response = AliyunService::sendSms($code_code, $request->get('mobile'));

        $code = new Code();
        $code->code = $code_code;
        $code->mobile = $request->get('mobile');
        $code->type_name = $request->get('type_name', '');
        $code->expired = time()+60*15;
        $code->save();

        $code->response = $response;

        return $this->sendResponse($code, '更新成功');
    }


}
