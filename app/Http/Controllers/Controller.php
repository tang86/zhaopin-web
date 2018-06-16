<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 说明:  api成功返回
     *
     * @param $result
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'data' => $result,
            'message' => $message
        ];
        return response()->json($response, 200);
    }

    /**
     * 说明:api错误返回
     *
     * @param $message
     * @param array $errors
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function sendError($message, $errors = [], $code = 404)
    {
        $response = [
            'errors' => $errors,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }
}
