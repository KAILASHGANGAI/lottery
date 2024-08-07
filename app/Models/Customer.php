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
        'cid',
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
        'refered_by',
        'nominee_holder_name',
        'nominee_relation',
        'nominee_phone',
        'temp_provision_id',
        'temp_district_id',
        'temp_gaupalika_id',
        'temp_ward_no',
        'reg_date',
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

    public function tempprovision()
    {
        return $this->belongsTo(Provision::class, 'temp_provision_id', 'id');
    }
    public function tempdistrict()
    {
        return $this->belongsTo(District::class, 'temp_district_id', 'id');
    }
    public function tempgaupalika()
    {
        return $this->belongsTo(Gaupalika::class, 'temp_gaupalika_id', 'id');
    }

    public function agent()
    {
        return $this->hasOne(Agents::class, 'id', 'refered_by');
    }

    public function deposits(){
        return $this->hasMany(Deposite::class, 'cid', 'cid')->orderby('id', 'DESC');
    }
}
