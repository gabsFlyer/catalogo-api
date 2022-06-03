<?php
namespace App\Http\Controllers\Api;

use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
           ]);

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
            return response()->json(['message' => 'Houve um erro no upload!'], 500);
        }

        $req = $request->all();
        $req['original_name'] = $originalName;
        $req['file_name'] = $fileName;
        $req['file_extension'] = $extension;

        return File::create($req);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
