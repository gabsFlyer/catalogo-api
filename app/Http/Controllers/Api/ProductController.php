<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(Product $model, ProductService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
