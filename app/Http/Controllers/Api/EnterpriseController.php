<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use App\Services\EnterpriseService;

class EnterpriseController extends Controller
{
    public function __construct(Enterprise $model, EnterpriseService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
