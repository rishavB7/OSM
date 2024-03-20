<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District_Master extends Model
{
    use HasFactory;

    protected $table = 'district_master';

    protected $fillable = [
        'unique_code',
        'district',
        'district_no',
        'district_type',
    ];

   

    
}