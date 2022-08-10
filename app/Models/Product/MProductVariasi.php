<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MProductVariasi extends Model
{
    use HasFactory;
    
    const productVariasiId        = 'productVariasiId'; 
    const productVariasiName      = 'productVariasiName';
    const productVariasiSku       = 'productVariasiSku';
    const productVariasiHargaJual = 'productVariasiHargaJual';

    protected $table = 'm_product_variasi';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
