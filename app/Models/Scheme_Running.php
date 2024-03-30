<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheme_Running extends Model
{
    use HasFactory;
    protected $table = 'scheme_running';
    protected $fillable = [
        'date_of_reporting',
        'phy_progress',
        'remarks',
    ];
}
