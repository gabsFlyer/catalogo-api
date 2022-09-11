<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    protected $with = ['enterprise', 'products'];

    protected $fillable = [
        'name',
        'initial_date',
        'final_date',

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
            'enterprise.id' => 'required',
            'initial_date' => 'required',
            'final_date' => 'required',
            'name' => 'required',
            'products' => 'required|array',
        ];
    }
}
