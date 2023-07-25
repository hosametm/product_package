<?php

namespace Hosam\ProductCrud\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colors extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];
}
