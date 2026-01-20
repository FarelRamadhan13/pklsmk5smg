<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class siswa extends Authenticatable
{
    use HasFactory;
   
    protected $guard = 'siswa';
    protected $table = 'siswa';
    protected $fillable = [
        'nama', 'alamat', 'password', 'telp', 'kelas', 'tahun', 'id_jurusan',
    ];
    protected $hidden = [
        'password',
    ];
    public function jurusan()
    {
        return $this->belongsTo(jurusan::class, 'id_jurusan');
    }
    protected $casts = [
        'nisn' => 'string', 
    ];

    protected $primaryKey = 'nisn';
    
}
