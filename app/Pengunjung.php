<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $primaryKey = "nik";
    protected $table = 'tbl_pengunjung';
    protected $fillable = ['nik','nama_pengunjung','alamat','jenis_kelamin','no_telpon'];
}
