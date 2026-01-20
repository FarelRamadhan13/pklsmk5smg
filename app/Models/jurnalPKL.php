<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnalPKL extends Model
{
    use HasFactory;
    protected $table = 'jurnalpkl';

    protected $casts = [
        'id' => 'string', 
    ];

}
