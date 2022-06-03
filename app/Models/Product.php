<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'weight',
        //'measurement_unit',
        'purchase_price',
        'unit_price',
        'wholesale_price',
        'wholesale_minimum_quantity',
        'maximum_percent_discount'
    ];

    public function rules(){
        return [
            'name' => 'required',
            'unit_price' => 'required|gt:0',
            'wholesale_price' => 'required|gt:0',
            'wholesale_minimum_quantity' => 'required|gt:0'
        ];
    }
}
