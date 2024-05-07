<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department_User_Map extends Model
{
    use HasFactory;

    protected $table = 'department_user_map';

    protected $fillable = ([
        'department_id',
        'user_id',
    ]);

    public function district_master(){
        return $this->belongsTo('App\Models\District_Master', 'department_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function department(){
        return $this->belongsTo('App\Models\Departments', 'department_id', 'id');
    }
}