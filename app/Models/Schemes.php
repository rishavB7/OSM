<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schemes extends Model
{
    use HasFactory;

    protected $table = 'schemes';
    protected $fillable = [
        'scheme_name',
        'scheme_description',
        'start_date',
        'end_date',
        'status',
    ];
}
