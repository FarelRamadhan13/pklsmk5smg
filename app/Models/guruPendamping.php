<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class guruPendamping extends Authenticatable
{
    protected $guard = 'pendamping';
    protected $table = 'tbl_gurupendamping';
    protected $fillable = [
        'nama', 'alamat', 'password', 'telp', 'kelas', 'tahun', 'id_jurusan'
    ];
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'nip' => 'string', 
    ];
    protected $primaryKey = 'nip';
   
    use HasFactory;
}
