<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposite extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'customer_name',
        'deposite_amount',
        'fine_amount',
        'due',
        'customer_by',
        'dod',
        'user_id'
    ];
}
