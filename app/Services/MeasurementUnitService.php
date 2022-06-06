<?php
namespace App\Services;

use App\Models\MeasurementUnit;

class MeasurementUnitService extends Service
{
    public function __construct(MeasurementUnit $model)
    {
        $this->model = $model;
    }

    public function index(){
        return $this->model::all();
    }
}
