<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MeasurementUnit;
use App\Services\MeasurementUnitService;

class MeasurementUnitController extends Controller
{
    public function __construct(MeasurementUnit $model, MeasurementUnitService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
