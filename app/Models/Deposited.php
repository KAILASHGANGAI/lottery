<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposited extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'depositeds';
    protected $guarded = [];

    public function customer(){
        return $this->hasOne(Customer::class, 'cid', 'cid');
    }
}
