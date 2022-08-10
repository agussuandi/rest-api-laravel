<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\InitResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\Product\MProduct;
use  App\Http\Resources\Product\ProductVariasiResource;

class ProductResource extends InitResource
{
    public function toArray($request): array
    {
        return [
            MProduct::productId      => $this->id,
            MProduct::productName    => $this->name,
            MProduct::productCode    => $this->code,
            MProduct::productBrand   => $this->brand,
            MProduct::productDesc    => $this->description,
            MProduct::productVariasi => ProductVariasiResource::collection($this->productVariasi)
        ];
    }
}
