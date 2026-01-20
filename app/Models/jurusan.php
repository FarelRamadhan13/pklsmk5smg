<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    protected $primaryKey = 'id_jurusan';
    protected $table ='tb_jurusan';
    use HasFactory;

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_jurusan');
    }
}
