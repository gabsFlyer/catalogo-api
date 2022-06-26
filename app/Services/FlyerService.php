<?php
namespace App\Services;

use App\Models\Flyer;

class FlyerService extends Service
{
    protected $relationships = ['enterprise'];

    public function __construct(Flyer $model)
    {
        $this->model = $model;
    }

}
