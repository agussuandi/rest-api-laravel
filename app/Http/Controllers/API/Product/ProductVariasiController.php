<?php

namespace App\Http\Controllers\API\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Throwable;

use App\Http\Services\Product\ProductVariasiServices;

class ProductVariasiController extends Controller
{
    public function __construct(private ProductVariasiServices $productVariasiServices)
    {
        $this->productVariasiServices = $productVariasiServices;
    }

    public function store(Request $request, $productId)
    {
        try
        {
            $productVariasi = $this->productVariasiServices->store($request, $productId);
            
            return response()->json([
                'status'  => true,
                'message' => 'Success store Product Variasi'
            ]);
        }
        catch (Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Failed store Product Variasi',
                'error'   => $th->getMessage()
            ]);
        }
    }

    public function update(Request $request, $productId, $productVariasiId)
    {
        try
        {
            $productVariasi = $this->productVariasiServices->update($request, $productId, $productVariasiId);
            
            return response()->json([
                'status'  => true,
                'message' => 'Success update Product Variasi'
            ]);
        }
        catch (Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Failed update Product Variasi',
                'error'   => $th->getMessage()
            ]);
        }
    }

    public function destroy($productId, $productVariasiId)
    {
        try
        {
            $product = $this->productVariasiServices->destroy($productId, $productVariasiId);
            
            return response()->json([
                'status'  => true,
                'message' => 'Success destroy Product Variasi'
            ]);
        }
        catch (Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}

