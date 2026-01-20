<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_prakerin extends Model
{
    use HasFactory;

    protected $primaryKey = 'idprakerin';
    protected $table = 'tb_prakerin';
    protected $fillable = [
        'idpkl', 'nisn', 'nip', 'start', 'end', 'n1', 'n2', 'n3', 'n4', 'n5', 'tahun', 'created_at', 'username' // 'create_at' diganti menjadi 'created_at'
    ];

    public function jurnalpkl()
    {
        return $this->hasMany(jurnalPKL::class, 'prakerin', 'idprakerin');
    }
}
