<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function show(Company $company)
    {
        return $this->sendResponse($company, '获取企业详情成功');
    }
}
