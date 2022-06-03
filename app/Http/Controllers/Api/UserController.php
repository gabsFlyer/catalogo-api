<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(User $model, UserService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }


}
