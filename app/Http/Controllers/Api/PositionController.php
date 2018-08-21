<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\District;
use App\Models\Position;
use App\Models\Salary;
use App\Models\UserHasPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

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

        $position->company['logo_url'] = URL::asset("uploads/{$position->company->logo}");

        $position['keywords_arr'] = explode(' ', $position->keywords);

        $full_name = '';

        if ($position->district->parent_id > 0) {
            $parent = District::where('id', $position->district->parent_id)->first();
            if ($parent) {
                $parent_name = $parent->name;
                $full_name = "{$parent_name}·{$position->district->name}";
                if ($parent->parent_id > 0) {
                    $granpa = $parent->distinct();
                    if ($granpa) {
                        $granpa_name = $granpa->name;
                        $full_name = "{$granpa_name}·{$full_name}";
                    }
                }
            }
        }



        $position->district->full_name = $full_name;

        return $this->sendResponse($position, '获取详情成功');
    }

    public function isSent(Request $request)
    {
        $where = [
            'user_id' => $request->get('user_id'),
            'position_id' => $request->get('position_id'),
        ];

        $user_has_position = UserHasPosition::where($where)->first();

        if ($user_has_position && $user_has_position->expired > time()) {

            return $this->sendResponse(true, '已投递');
        } else {
            return $this->sendResponse(false, '未投递');
        }

    }

    public function getConditions()
    {
        $company_categories = CompanyCategory::orderByDesc('sort')->get();
        $salaries = Salary::orderByDesc('sort')->get();
        $data = [
            'company_categories' => $company_categories,
            'salaries' => $salaries
        ];
        return $this->sendResponse($data, '获取查询条件');
    }


}
