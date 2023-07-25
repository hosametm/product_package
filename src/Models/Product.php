<?php

namespace Hosam\ProductCrud\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'published'];

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', 0);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%");
    }

    public function productStock()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }


}
