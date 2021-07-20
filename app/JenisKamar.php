<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKamar extends Model
{
    protected $primaryKey = "id_jenis_kamar";
    protected $table = 'tbl_jenis_kamar';
    protected $fillable = ['Jenis_kamar'];

    public function kamar(){
        return $this->belongsTo(Kamar::class,'id_jenis_kamar','Jenis_kamar');
    }
}
