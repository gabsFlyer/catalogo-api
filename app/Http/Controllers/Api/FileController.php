<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Services\FileService;

class FileController extends Controller
{

    public function __construct(File $model, FileService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }

}
