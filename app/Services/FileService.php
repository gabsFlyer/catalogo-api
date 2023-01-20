<?php
namespace App\Services;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class FileService extends Service
{
    private $acceptable_extensions = ['jpg', 'png', 'webp', 'jpeg'];

    public function __construct(File $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        if (!$request->has('image') || !strpos($request->image, ';base64')) {
            return response()->json(['message' => 'Arquivo não enviado'], 400);
        }

        $uuid = Str::uuid();
        $base64Image = $request->image;

        $extension = explode('/', $base64Image);
        $extension = explode(';', $extension[1]);
        $extension = $extension[0];
        $fileName = "{$uuid}.{$extension}";

        if (!in_array($extension, $this->acceptable_extensions)) {
            return response()->json(['message' => 'Arquivo enviado em um formato inválido'], 400);
        }


        $file = explode(',', $base64Image);
        $file = $file[1];

        $upload = Image::make(base64_decode($file))
            -> save(storage_path("app/public/$fileName", 70));

        if (!$upload) {
            return response()->json(['message' => 'Houve um erro no upload'], 500);
        }

        $req = $request->all();
        $req['file_name'] = $fileName;
        $req['file_extension'] = $extension;

        return $this->model::create($req);
    }

    public function destroy($id)
    {
        $fileToDelete = $this->model::findOrFail($id);
        $fileName = $fileToDelete->file_name;
        $file  = storage_path("app/public/$fileName");

        if (file_exists($file)) {
            unlink($file);
        }

        return parent::destroy($id);
    }

    public function rotate($id)
    {
        $file = $this->model::findOrFail($id);
        $fileName = $file->file_name;
        $fileLocation = storage_path("app/public/$fileName");

        Image::make($fileLocation)
            ->rotate(-90)
            ->save($fileLocation);

        return $file;
    }
}
