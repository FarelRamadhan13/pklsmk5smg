<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kegiatan_harian extends Model
{
    protected $table = 'kegiatan_harian_siswa';
    protected $primaryKey = 'id_kegiatan';
    use HasFactory;

    protected $casts = [
        'id_kegiatan' => 'string', 
    ];

}
