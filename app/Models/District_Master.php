<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District_Master extends Model
{
    use HasFactory;

    protected $table = 'district_master';

    protected $fillable = [
        'unique_code',
        'district',
        'district_no',
        'district_type',
    ];
    

    public function district_user_map() {
        return $this->belongsTo('App\Models\District_User_Map', 'unique_code', 'district_unique_code');
    }



    // public function Election_district_user_map()
    // {
    //     return $this->hasOne('App\Models\Election_district_user_map', 'unique_code', 'unique_code');
    // }
    
}