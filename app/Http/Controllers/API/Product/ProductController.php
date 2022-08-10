<?php

namespace App\Http\Controllers\API\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Throwable;

use App\Http\Services\Product\ProductServices;

class ProductController extends Controller
{
    public function __construct(private ProductServices $productServices)
    {
        $this->productServices = $productServices;
    }

    public function index(Request $request)
    {
        try
        {
            $product = $this->productServices->index($request);
            return response()->json($product);
        }
        catch (Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Failed get Product',
                'error'   => $th->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try
        {
            $product = $this->productServices->store($request);
            
            return response()->json([
                'status'  => true,
                'message' => 'Success store Product'
            ]);
        }
        catch (Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Failed store Product',
                'error'   => $th->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try
        {
            return response()->json([
                'status' => true,
                'data'   => $this->productServices->show($id)
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

    public function update(Request $request, $id)
    {
        try
        {
            $product = $this->productServices->update($request, $id);
            
            return response()->json([
                'status'  => true,
                'message' => 'Success update Product'
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

    public function destroy($id)
    {
        try
        {
            $product = $this->productServices->destroy($id);
            
            return response()->json([
                'status'  => true,
                'message' => 'Success destroy Product'
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