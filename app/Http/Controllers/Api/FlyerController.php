<?php
namespace App\Http\Controllers\Api;

use App\Dtos\FlyerDto;
use App\Http\Controllers\Controller;
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
