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
        'physical_progress',
        'percentage_of_progress',
        'images',
        'scheme_status',
        'budget',
        'remaining_budget',
        'projectc_coordinator',
        'created_by',
    ];
}