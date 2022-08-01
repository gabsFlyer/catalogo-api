<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    protected $with = ['enterprise', 'products'];

    protected $fillable = [
        'name',
        'valid_until',

        'enterprise_id',
    ];

    protected $hidden = [
        'enterprise_id',
    ];

    public function enterprise() {
        return $this->belongsTo(Enterprise::class);
    }

    public function products() {
        return $this->hasMany(FlyerProduct::class);
    }

    public function rules(){
        return [
            'name' => 'required',
            'valid_until' => 'required',
            'enterprise.id' => 'required',
            'products' => 'required|array',
        ];
    }
}
