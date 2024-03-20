<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSchemes extends Model
{
    use HasFactory;

    protected $connection;

    protected $table = 'testSchmes';
    protected $fillable = [
        'scheme_name',
    ];


    public function changeConnection($conn)
    {
        $this->connection = $conn;
    }

}
