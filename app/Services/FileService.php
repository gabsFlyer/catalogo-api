<?php
namespace App\Services;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class FileService extends Service
{
    public function __construct(File $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        if (!$request->hasFile('image') || !$request->file('image')->isValid()) {
            return response()->json(['message' => 'Arquivo não enviado'], 400);
        }

        $uuid = Str::uuid();
        $extension = $request->file('image')->getClientOriginalExtension();
        $originalName = $request->file('image')->getClientOriginalName();
        $fileName = "{$uuid}.{$extension}";

        $upload = Image::make($request->file('image'))
            -> save(storage_path("app/public/$fileName", 70));

        if (!$upload) {
            return response()->json(['message' => 'Houve um erro no upload'], 500);
        }

        $req = $request->all();
        $req['original_name'] = $originalName;
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
}
