<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'product_name',
        'product_code',
        'total_quantity',
        'buying_price',
        'selling_price',
        'supplier_name',
        'buying_date',
        'image',
        'availabel_quantity',
        'sold_quantity',
        'recommendation',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
