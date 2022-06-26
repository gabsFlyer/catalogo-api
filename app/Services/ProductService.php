<?php
namespace App\Services;

use App\Models\Product;

class ProductService extends Service
{
    protected $relationships = ['measurement_unit', 'file'];

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
