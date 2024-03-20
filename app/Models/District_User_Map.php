<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District_User_Map extends Model
{
    use HasFactory;

    protected $table = 'district_user_map';

    protected $fillable = [
        'user_id',
        'district_id',
        'district_unique_code'
    ];

    public function district_master(){
        return $this->belongsTo('App\Models\District_Master', 'district_unique_code', 'unique_code');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
