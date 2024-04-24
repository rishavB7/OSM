<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeProgress extends Model
{
    use HasFactory;
    
    protected $table = 'scheme_progress';
    protected $fillable = [
        'scheme_id',
        'no_of_entries',
        'percentage_of_progress',
        'images',
        'funds_used',
        'physical_progress',
        'queries',
    ];

    public function scheme(){
        return $this->belongsTo('App\Models\Schemes', 'scheme_id', 'id');
    }
}
