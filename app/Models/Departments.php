<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    protected $table = 'department';

    protected $fillable = [
        'id',
        'department_name',
    ];

    public function district_user_map() {
        return $this->belongsTo('App\Models\District_User_Map', 'department_id', 'id');
    }

}
