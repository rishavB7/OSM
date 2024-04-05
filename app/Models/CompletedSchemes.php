<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedSchemes extends Model
{
    use HasFactory;

    protected $table = 'completed_schemes';

    protected $fillable = [
        'scheme_name',
        'scheme_description',
        'start_date',
        'end_date',
        'status',
        'physical_progress',
        'percentage_of_progress',
        'img1',
        'img2',
        'img3',
        'img4',
        'completion_year',
        'achievement',
    ];

}