<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposite extends Model
{
    use HasFactory, SoftDeletes;
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
