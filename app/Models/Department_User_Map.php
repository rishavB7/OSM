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

     
}
