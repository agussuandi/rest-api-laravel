<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MProduct extends Model
{
    use HasFactory;
    const ACTIVE   = 1;
    const INACTIVE = 0;

    const productId      = 'productId';
    const productName    = 'productName';
    const productCode    = 'productCode';
    const productBrand   = 'productBrand';
    const productDesc    = 'productDesc';
    const productVariasi = 'productVariasi';
    
    protected $table = 'm_product';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function scopeActive($query)
    {
        $query->where('flag_active', self::ACTIVE);
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function($where) use($search) {
            $where->orWhereRaw("name like '%{$search}%'")->orWhereRaw("description like '%{$search}%'");
        });
    }

    public function productVariasi()
    {
        return $this->hasMany(MProductVariasi::class, 'product_id', 'id');
    }
}
