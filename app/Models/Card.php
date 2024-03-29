<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $tabel = 'cards';
    protected $fillable = ['product_id', 'product_name', 'price', 'quantity', 'subtotal'];
}
