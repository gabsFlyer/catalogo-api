<?php
namespace App\Services;

use App\Models\Flyer;
use App\Models\FlyerProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlyerService extends Service
{
    protected $relationships = ['enterprise'];

    public function __construct(Flyer $model, Product $productModel)
    {
        $this->model = $model;
        $this->productModel = $productModel;
    }

    public function store(Request $request)
    {
        $flyer = parent::store($request);

        $flyerId = $flyer->id;
        $flyerProducts = $request->all()['products'];

        $this->saveFlyerProducts($flyerId, $flyerProducts);

        return $this->model->findOrFail($flyer->id);
    }

    public function update(Request $request, $id)
    {
        $flyer = parent::update($request, $id);

        $flyerId = $flyer->id;
        $flyerProducts = $request->all()['products'];

        $this->deleteAllFlyerProducts($flyerId);
        $this->saveFlyerProducts($flyerId, $flyerProducts);

        return $this->model->findOrFail($id);
    }

    private function deleteAllFlyerProducts($flyerId)
    {
        DB::table('flyer_product')->where('flyer_id', $flyerId)->delete();
    }

    private function saveFlyerProducts($flyerId, $flyerProducts)
    {
        foreach ($flyerProducts as $flyerProduct) {
            $model = new FlyerProduct();
            $model['product_id'] = $flyerProduct['product']['id'];
            $model['flyer_id'] = $flyerId;

            if (array_key_exists('validity', $flyerProduct)) {
                $model['validity'] = $flyerProduct['validity'];
            }

            if (array_key_exists('offer_price', $flyerProduct)) {
                $model['offer_price'] = $flyerProduct['offer_price'];
            }

            $model->save();
        }
    }

}
