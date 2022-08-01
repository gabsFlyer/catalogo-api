<?php
namespace App\Http\Controllers;

use App\Models\Flyer;
use App\Services\FlyerService;

class FlyerController extends Controller
{
    public function __construct(Flyer $model, FlyerService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
