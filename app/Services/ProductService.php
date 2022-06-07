<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductService extends Service
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function store(Request $request) {
        $measurementUnit = $request->input('measurement_unit');

        if($measurementUnit != null && in_array('id', array_keys($measurementUnit))){
            $request->merge([
                'measurement_unit_id' => $measurementUnit['id']
            ]);
        }

        return parent::store($request);
    }

    public function update(Request $request, $id) {
        $measurementUnit = $request->input('measurement_unit');

        if($measurementUnit != null && in_array('id', array_keys($measurementUnit))){
            $request->merge([
                'measurement_unit_id' => $measurementUnit['id']
            ]);
        }

        return parent::update($request, $id);
    }
}
