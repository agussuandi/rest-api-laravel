<?php

namespace App\Http\Services\Product;

use DB;

use App\Models\User;
use App\Models\Product\MProduct;
use App\Models\Product\MProductVariasi;

use App\Http\Resources\Product\ProductVariasiResource;

class ProductVariasiServices
{
    public function store($request, $productId)
    {
        $productVariasi = DB::transaction(function () use ($request, $productId) {
            $mProduct = MProduct::find($productId);
            foreach ($request['productVariasi'] as $keyVariasi => $valVariasi)
            {
                $strTime = strtotime(now());
                $mProductVariasi             = new MProductVariasi;
                $mProductVariasi->product_id = $mProduct->id;
                $mProductVariasi->name       = $valVariasi['productVariasiName'];
                $mProductVariasi->sku        = "{$mProduct->code}.{$strTime}.{$keyVariasi}";
                $mProductVariasi->harga      = $valVariasi['productVariasiHargaJual'];
                $mProductVariasi->created_by = $mProduct->created_by;
                $mProductVariasi->created_at = now();
                $mProductVariasi->save();
            }
        });
    }

    public function update($request, $productId, $productVariasiId)
    {
        $productVariasi = DB::transaction(function () use ($request, $productVariasiId) {
            $mProductVariasi             = MProductVariasi::find($productVariasiId);
            $mProductVariasi->name       = $request->input('productVariasiName');
            $mProductVariasi->harga      = $request->input('productVariasiHargaJual');
            $mProductVariasi->updated_by = User::getIdentityToken($request->bearerToken())->userId;
            $mProductVariasi->updated_at = now();
            $mProductVariasi->save();

            return $mProductVariasi;
        });

        return new ProductVariasiResource($productVariasi);
    }

    public function destroy($productId, $productVariasiId)
    {
        $product = DB::transaction(function () use ($productVariasiId) {
            MProductVariasi::find($productVariasiId)->delete();
        });
    }
}