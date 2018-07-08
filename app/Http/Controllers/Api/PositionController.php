<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Position;
use App\Models\Salary;
use App\Models\UserHasPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $page_size = $request->page_size??10;
        $where = [
            'status' => 1
        ];
        $query = Position::where($where);

        if (isset($request->selectedConditions)) {
            if (!empty($request->selectedConditions)) {
                $selected_conditions = json_decode($request->selectedConditions, true);
                foreach ($selected_conditions as $key => $condition) {
                    if ($key == 'company_category_id') {
                        if (!empty($condition)) {
                            $company_ids = Company::whereIn('company_category_id', $condition)->get()->pluck('id');
                            $query->whereIn('company_id', $company_ids);
                        }


                    } else {
                        if (!empty($condition)) {
                            $query->whereIn($key,$condition);
                        }

                    }

                }
            }

        }
        $data = $query
            ->with('company')
            ->with('district')
            ->with('salary')
            ->orderBy('sort', 'desc')
            ->paginate($page_size);

        if(!empty($data)){
            foreach ($data as &$item) {
                $item['keywords_arr'] = explode(' ', $item['keywords']);
            }

            return $this->sendResponse($data, '获取成功！');
        }
        return $this->sendResponse(false, '没有数据！');
    }

    public function sentPositions(Request $request)
    {
        $page_size = $request->page_size??10;
        $user_id = $request->get('user_id');
        $data = UserHasPosition::where(['user_id' => $user_id])->paginate($page_size);
//        $data = Position::where('status', 1)
//            ->with('company')
//            ->with('district')
//            ->with('salary')
//            ->orderBy('sort', 'desc')
//            ->paginate($page_size);

        if(!empty($data)){
            foreach ($data as &$item) {
                $item->position;
                $item->position->company;
                $item->position->district;
                $item->position->salary;

                $item->position['keywords_arr'] = explode(' ', $item->position['keywords']);
            }

            return $this->sendResponse($data, '获取成功！');
        }
        return $this->sendResponse(false, '没有数据！');
    }

    public function show(Position $position)
    {
        $position->company;
        $position->district;
        $position->salary;
        $position->company->company_category;
        $position->company->company_size;
        $position->company->company_status;
        $position->company->district;

        $position['keywords_arr'] = explode(' ', $position->keywords);

        return $this->sendResponse($position, '获取详情成功');
    }

    public function isSent(Request $request)
    {

        $where = [
            'user_id' => $request->get('user_id'),
            'position_id' => $request->get('position_id'),
        ];
        $user_has_position = UserHasPosition::where($where)->first();
        if ($user_has_position) {
            return $this->sendResponse(true, '已投递');
        } else {
            return $this->sendResponse(false, '未投递');
        }

    }

    public function getConditions()
    {
        $company_categories = CompanyCategory::all();
        $salaries = Salary::all();
        $data = [
            'company_categories' => $company_categories,
            'salaries' => $salaries
        ];
        return $this->sendResponse($data, '获取查询条件');
    }


}
