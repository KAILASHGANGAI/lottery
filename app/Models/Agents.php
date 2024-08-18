<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agents extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='agents';
    protected $guarded = [];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'refered_by', 'id');
    }
}
