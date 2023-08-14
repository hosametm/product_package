<?php

namespace Hosam\ProductCrud\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductStock extends Model
{
    use HasFactory;

    protected $table = 'product_stocks';
    protected $fillable = [
        'product_id', 'stock', 'price', 'quantity', 'size', 'color'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
