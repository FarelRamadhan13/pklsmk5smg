<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kunjungan extends Model
{
    protected $table = 'tbl_kunjungan';
    protected $primaryKey = 'idkunjungan';
    use HasFactory;
}
