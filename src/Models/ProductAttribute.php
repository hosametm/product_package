<?php

namespace Hosam\ProductCrud\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attributes';

    public function productStock()
    {
        return $this->hasOne(ProductStock::class);
    }
}
