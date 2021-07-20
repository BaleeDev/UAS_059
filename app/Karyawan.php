<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $primaryKey = "id_karyawan";
    protected $table = 'tbl_karyawan';
    protected $fillable = ['nama_karyawan','jenis_kelamin'];
}
