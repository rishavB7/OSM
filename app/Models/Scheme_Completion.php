<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheme_Completion extends Model
{
    use HasFactory;
    protected $table = 'scheme_completion';
    protected $fillable = [
        'date_of_reporting',
        'achievement',
    ];
}
