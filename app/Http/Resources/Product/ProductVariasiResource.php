<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\InitResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\Product\MProduct;

class ProductVariasiResource extends InitResource
{
    public function toArray($request): array
    {
        return [
            'productVariasiId'        => $this->id,
            'productVariasiName'      => $this->name,
            'productVariasiSku'       => $this->sku,
            'productVariasiHargaJual' => $this->harga
        ];
    }
}
