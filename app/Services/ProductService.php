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
        $request = $this->moveIdFromObject($request, 'measurement_unit');
        $request = $this->moveIdFromObject($request, 'file');

        return parent::store($request);
    }

    public function update(Request $request, $id) {
        $request = $this->moveIdFromObject($request, 'measurement_unit');
        $request = $this->moveIdFromObject($request, 'file');

        return parent::update($request, $id);
    }

    private function moveIdFromObject(Request $request, $table) {
        $child = $request->input($table);
        if($child != null && in_array('id', array_keys($child))){
            $request->merge([
                "{$table}_id" => $child['id']
            ]);
        }

        return $request;
    }
}
