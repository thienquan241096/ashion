<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $fillable = ['product_name', 'brand', 'price', 'sale', 'size', 'color', 'description', 'highlight', 'cate_id'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'id');
    }

    public function cart_detail()
    {
        return $this->hasMany(CartDetail::class, 'product_id', 'id');
    }
}