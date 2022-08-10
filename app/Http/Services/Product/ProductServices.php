<?php

namespace App\Http\Services\Product;

use DB;

use App\Models\User;
use App\Models\Product\MProduct;
use App\Models\Product\MProductVariasi;

use App\Http\Resources\Product\ProductResource;
use App\Http\Services\Product\ProductVariasiServices;

class ProductServices
{
    public function index($request)
    {
        $limit = $request->input('limit') ?? 10;

        $products = MProduct::with('productVariasi')
            ->select('id', 'name', 'code', 'brand', 'description')
        ->paginate($limit);
        
        return ProductResource::collection($products);
    }

    public function store($request)
    {
        $product = DB::transaction(function () use ($request) {
            $mProduct              = new MProduct;
            $mProduct->name        = $request->input('productName');
            $mProduct->code        = self::generateCodeProduct();
            $mProduct->brand       = $request->input('productBrand');
            $mProduct->description = $request->input('productDescription');
            $mProduct->created_by  = User::getIdentityToken($request->bearerToken())->userId;
            $mProduct->created_at  = now();
            $mProduct->save();

            $productVariasiServices = new ProductVariasiServices;
            $productVariasiServices->store($request, $mProduct->id);
            
            return $mProduct;
        });

        return new ProductResource($product);
    }

    public function show($id)
    {
        $product = MProduct::with('productVariasi')
            ->where('id', $id)
        ->first();

        return new ProductResource($product);
    }

    public function update($request, $id)
    {
        $product = DB::transaction(function () use ($request, $id) {
            $mProduct              = MProduct::find($id);
            $mProduct->name        = $request->input('productName');
            $mProduct->brand       = $request->input('productBrand');
            $mProduct->description = $request->input('productDescription');
            $mProduct->updated_by  = User::getIdentityToken($request->bearerToken())->userId;
            $mProduct->updated_at  = now();
            $mProduct->save();

            return $mProduct;
        });

        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $product = DB::transaction(function () use ($id) {
            MProduct::find($id)->delete();
        });
    }

    protected static function generateCodeProduct()
    {
        $mProduct = MProduct::selectRaw('MAX(SUBSTRING(code, 2, 6)) as code_subs')
            ->whereRaw('substring(code, -2) = '.date('y'))
            ->orderBy('id', 'DESC')
        ->first();

        if($mProduct) {
            $maxMohonIdValid = (int)$mProduct->code_subs;
            $urutan = $maxMohonIdValid + 1;
        }
        else {
            $urutan = 1;
        }

        return $newNoReg = 1 . str_pad($urutan, 6, 0, STR_PAD_LEFT) . '.' . date('y');
    }
}