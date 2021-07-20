<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $primaryKey = "kode_kamar";
    protected $table = 'tbl_kamar';
    protected $fillable = ['Tarif','Jenis_kamar','Status','Nama_kamar'];

    public function jeniskamar()
    {
        return $this->belongsTo(JenisKamar::class, 'Jenis_kamar');
    }
}
