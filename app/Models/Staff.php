<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'staffs';

    protected $fillable = [
        'name',
        'phone',
        'provision_id',
        'district_id',
        'gaupalika_id',
        'ward_no',
        'gender',
        'citizenship_no',
        'joiningdate',
        'status',
        'photo',
        'salary'
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
