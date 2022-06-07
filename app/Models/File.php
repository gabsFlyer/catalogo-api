<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'description',
        'original_name',
        'file_name',
        'file_extension'
    ];

    public function rules(){
        return [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];
    }
}
