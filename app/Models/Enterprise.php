<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    protected $with = ['file'];

    protected $fillable = [
        'name',
        'whatsapp',

        'file_id'
    ];

    protected $hidden = [
        'file_id'
    ];

    public function rules() {
        return [
            'name' => 'required',
            'whatsapp' => 'required'
        ];
    }

    public function file() {
        return $this->belongsTo(File::class);
    }
}
