<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Http\Controllers\Controller;

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
        return $this->sendResponse($company, '获取企业详情成功');
    }
}
