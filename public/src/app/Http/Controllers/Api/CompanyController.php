<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class CompanyController extends Controller
{
    public function show(Company $company)
    {
        $company->company_category;
        $company->company_size;
        $company->company_status;
        $company->district;
        $company->positions;
        foreach ($company->positions as &$position) {
            $position->company;
            $position->district;
            $position->salary;
            $position['keywords_arr'] = explode(' ', $position->keywords);
        }
        $company['logo_url'] = URL::asset("uploads/{$company->logo}");
        if (!empty($company->imgs) && is_array($company->imgs)) {
            $img_urls = [];
            $number = 1;
            foreach ($company->imgs as $img) {
                $temp = [];
                $temp['id'] = $number;
                $temp['banner'] = URL::asset("uploads/{$img}");
                $number++;
                $img_urls[] = $temp;
            }
            $company['img_urls'] = $img_urls;
        }
        return $this->sendResponse($company, '获取企业详情成功');
    }
}
