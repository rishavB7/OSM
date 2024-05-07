<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheme_Supervisor_Map extends Model
{
    use HasFactory;

    protected $table = 'scheme_supervisor_map';

    protected $fillable = ([
        'supervisor_id',
        'scheme_id',
    ]);

}
