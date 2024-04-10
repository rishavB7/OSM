<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class handle_queries_table extends Model
{
    use HasFactory;

    protected $table = 'handle_queries_table';

    protected $fillable = [
        'scheme_name',
        'start_date',
        'pending_queries'
    ];

}