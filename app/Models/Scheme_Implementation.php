<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheme_Implementation extends Model
{
    use HasFactory;

    protected $table = 'scheme_implementation';
    protected $fillable = [
        'date_of_reporting',
    ];
}
