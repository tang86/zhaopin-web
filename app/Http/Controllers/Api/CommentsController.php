<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CommentsRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class CommentsController extends Controller
{
    /**
     * 说明: 获取评论信息
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function index(Request $request)
    {
        $query = Comment::query();
        $query->when($request->goods_id??null, function ($q, $value) {
            return $q->where(['goods_id' => $value]);
        });
        $query->when($request->parent_id??null, function ($q, $value) {
            return $q->where(['parent_id' => $value]);
        });
        $query->when($request->user_id??null, function ($q, $value) {
            return $q->where(['user_id' => $value]);
        });
        if (!empty($request->per_page) && $request->per_page == 'all') {
            $data = $query->where(['status'=>1])->orderBy('updated_at', 'desc')
                ->get()
                ->map(function ($item) {
                    return Comment::getItems($item);
                });
        } else {
            $data = $query->where(['status'=>1])->orderBy('updated_at', 'desc')
                ->paginate($request->per_page??10);
            $comments = $data->map(function ($item) {
                return Comment::getItems($item);
            });
            $data = $data->toArray();
            $data['data'] = $comments;
        }
        return $this->sendResponse($data, '获取评论成功！');
    }

    /**
     * 说明: 发表评论
     *
     * @param CommentsRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author 郭庆
     */
    public function store(CommentsRequest $request)
    {
        $user = Auth::guard('api')->user();
        $data = [
            'user_id' => $user->id,
            'goods_id' => $request->goods_id??null,
            'parent_id' => $request->parent_id??null,
            'title' => $request->title??null,
            'content' => $request->get('content'),
        ];
        Comment::create($data);
        return $this->sendResponse($data, '评论成功');
    }
}
