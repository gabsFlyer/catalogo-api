<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $with = ['measurementUnit'];

    protected $fillable = [
        'name',
        'description',
        'weight',
        'purchase_price',
        'unit_price',
        'wholesale_price',
        'wholesale_minimum_quantity',
        'maximum_percent_discount',
        'measurement_unit_id'
    ];

    protected $hidden = [
        'measurement_unit_id'
    ];

    public function rules() {
        return [
            'name' => 'required',
            'unit_price' => 'required|gt:0',
            'wholesale_price' => 'required|gt:0',
            'wholesale_minimum_quantity' => 'required|gt:0'
        ];
    }

    public function measurementUnit() {
        return $this->belongsTo(MeasurementUnit::class);
    }
}
