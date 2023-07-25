<?php

namespace Hosam\ProductCrud\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'stock', 'price', 'quantity','size','color'
    ];

}
