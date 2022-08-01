<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlyerProduct extends Model
{
    protected $table = 'flyer_product';
    protected $with = ['product'];

    protected $fillable = [
        'validity',

        'flyer_id',
        'product_id',
    ];

    protected $hidden = [
        'enterprise_id',
        'product_id',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
