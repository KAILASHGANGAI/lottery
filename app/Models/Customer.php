<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'phone',
        'provision_id',
        'district_id',
        'gaupalika_id',
        'ward_no',
        'lottery_amount',
        'photo',
        'gender',
        'citizenship_no',
        'occupation',
        'salary',
        'wlocation',
        'father_name',
        'mother_name',
        'hf_name',
        'no_of_members',
        'refered_by'
    ];
    public function provision()
    {
        return $this->belongsTo(Provision::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function gaupalika()
    {
        return $this->belongsTo(Gaupalika::class);
    }
}
