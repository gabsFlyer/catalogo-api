<?php
namespace App\Services;

use App\Models\Flyer;
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
        $products = $this->getProductsList($request->all()['products']);

        $productsToAttach = [];
        foreach ($products as $product) {
            $validity = $this->getValidityFromResponse($request, $product->id);
            $productsToAttach[$product->id] = ['validity' => $validity];
        }

        $flyer->products()->attach($productsToAttach);

        return $this->model->findOrFail($flyer->id);
    }

    public function update(Request $request, $id)
    {
        $flyer = parent::update($request, $id);

        $this->deleteAllFlyerProducts($flyer["id"]);
        $products = $this->getProductsList($request->all()['products']);

        $productsToAttach = [];
        foreach ($products as $product) {
            $validity = $this->getValidityFromResponse($request, $product->id);
            $productsToAttach[$product->id] = ['validity' => $validity];
        }

        $flyer->products()->attach($productsToAttach);

        return $this->model->findOrFail($id);
    }

    private function getProductsList($products) {
        $productList = [];

        foreach($products as $product) {
            if (array_key_exists('id', $product)) {
                $productModel = $this->productModel::findOrFail($product['id']);
                array_push($productList, $productModel);
            }
        }

        return $productList;
    }

    private function getValidityFromResponse(Request $request, $productId) {
        $products = $request->all()['products'];
        foreach($products as $product) {
            if ($product['id'] == $productId) {
                var_dump($product);
                if (array_key_exists('validity', $product)) {
                    print('ACHOU');
                    return $product['validity'];
                }
            }
        }

        return null;
    }

    private function deleteAllFlyerProducts($flyerId)
    {
        DB::table('flyer_product')->where('flyer_id', $flyerId)->delete();
    }

}
