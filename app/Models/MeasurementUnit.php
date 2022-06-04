<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model
{
    protected $fillable = [
        'unit',
        'description'
    ];

    public function rules(){
        return [
            'unit' => 'required'
        ];
    }
}
