<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pkl extends Model
{
    protected $primaryKey = 'idpkl';
    protected $table = 'tb_pkl';
    use HasFactory;
}
