<?php

namespace Hosam\ProductCrud\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'path', 'name', 'type', 'size'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
