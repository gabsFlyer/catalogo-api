<?php
namespace App\Services;

use App\Models\Product;

class ProductService extends Service
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
