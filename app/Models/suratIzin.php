<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suratIzin extends Model
{
    protected $table = 'suratizinpkl';
    protected $primaryKey = 'id_izin';
    use HasFactory;
}
