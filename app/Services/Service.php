<?php
namespace App\Services;

use Illuminate\Http\Request;
use PDOException;

class Service
{
    public function index(){
        return $this->model::paginate();
    }

    public function show($id)
    {
        return $this->model::findOrFail($id);
    }

    public function store(Request $request)
    {
        return $this->model::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $model = $this->model::findOrFail($id);
        $model->update($request->all());
        return $model;
    }

    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);
        return $model->delete();
    }

    protected function getUniqueValidationError(PDOException $ex)
    {
        switch($ex->errorInfo[1])
        {
            // duplicate entry
            case 1062:
                $message = $ex->errorInfo[2];
                $words = explode('_', $message);
                if (count($words) === 3)
                {
                    return $words[1];
                }
                break;
        }
    }
}
