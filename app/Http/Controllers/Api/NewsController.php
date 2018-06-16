<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * 说明: 专家专栏列表数据
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function index(Request $request)
    {
        $data = News::orderBy('sort', 'desc')
            ->orderBy('read_num', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate($request->per_page??10);

        if(!empty($data)){
            foreach ($data as $val) {
                $val['banner']  = url('uploads/'.$val['banner']);
            }
            return $this->sendResponse($data, '获取专家专栏成功！');
        }
        return $this->sendResponse(false, '专家专栏没有数据！');
    }

    /**
     * 说明: 新闻详情
     *
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function show(News $news)
    {
        $news['banner']  = url('uploads/'.$news['banner']);
        return $this->sendResponse($news, '获取新闻详情成功');
    }

    /**
     * 说明: 获取首页轮播专家专栏接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function getBannerNews(Request $request)
    {
        $data = News::where(['banner_status' => 1])
            ->orderBy('sort', 'desc')
            ->orderBy('read_num', 'desc')
            ->orderBy('updated_at', 'desc')
            ->limit($request->num??3)
            ->get();
        if(!empty($data)){
            foreach ($data as $val) {
                $val['banner']  = url('uploads/'.$val['banner']);
            }
            return $this->sendResponse($data, '获取首页轮播专家专栏成功！');
        }
        return $this->sendResponse(false, '没有数据！');
    }
}
