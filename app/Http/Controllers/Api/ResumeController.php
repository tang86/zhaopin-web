<?php

namespace App\Http\Controllers\Api;

use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResumeController extends Controller
{
    public function getCompanyCategories()
    {
        $company_categories = CompanyCategory::all()->pluck('name');

        return $this->sendResponse($company_categories, '获取成功');
    }
}
