<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hadir extends Model
{
    protected $table = 'daftar_hadir_siswa';
    protected $primaryKey = 'id_hadir';
    use HasFactory;

    protected $casts = [
        'id_hadir' => 'string', 
    ];

}
