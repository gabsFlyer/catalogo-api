<?php
namespace App\Services;

use App\Models\Enterprise;
use Illuminate\Http\Request;

class EnterpriseService extends Service
{
    public function __construct(Enterprise $model)
    {
        $this->model = $model;
    }

    public function store(Request $request) {
        $request = $this->moveIdFromObject($request, 'file');

        return parent::store($request);
    }

    public function update(Request $request, $id) {
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
