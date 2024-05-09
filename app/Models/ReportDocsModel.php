<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDocsModel extends Model
{
    use HasFactory;

    protected $table = 'report_docs';

    protected $fillable = [
        'subject',
        'filename',
        'uploaded_by',
        'ip_address'
    ];
}