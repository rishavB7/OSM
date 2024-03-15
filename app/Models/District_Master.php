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

    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'district_user_map', 'district_unique_code', 'user_id');
    }



    public function district_user_map(): BelongsTo {
        return $this->belongsTo('App\Models\District_User_Map', 'unique_code', 'district_unique_code');
    }
    
}