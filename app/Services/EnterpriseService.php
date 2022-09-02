<?php
namespace App\Services;

use App\Models\Enterprise;

class EnterpriseService extends Service
{
    protected $relationships = ['file'];

    public function __construct(Enterprise $model)
    {
        $this->model = $model;
    }
}
