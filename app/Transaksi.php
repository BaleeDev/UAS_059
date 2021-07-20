<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = "no_transaksi";
    protected $table = 'tbl_transaksi';
    protected $fillable = ['nik_pengunjung','id_karyawan','kode_kamar','lama_nginap','harga'];

    // relasi tbl transaksi dengan tabel pengunjung
    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'nik_pengunjung');
    }
    // relasi tbl transaksi dengan tabel karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
    // relasi tbl transaksi dengan tabel Kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kode_kamar');
    }
}
