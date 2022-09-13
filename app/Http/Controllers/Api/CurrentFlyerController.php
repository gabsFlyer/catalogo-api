<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CurrentFlyerService;

class CurrentFlyerController extends Controller
{
    public function getCurrentFlyer()
    {
        $currentFlyerService = new CurrentFlyerService();
        return $currentFlyerService->getCurrentFlyer();
    }
}
