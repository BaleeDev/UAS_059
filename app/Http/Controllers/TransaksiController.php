<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::with('pengunjung','kamar','karyawan')->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // validasi pemesanan kamar
        $validator = Validator::make($request->all(), [ 
            'nik_pengunjung' => 'required',
            'id_karyawan' => 'required',
            'kode_kamar' => 'required',
            'lama_nginap' => 'required',
        ]);
        
        if($validator->passes()){
            // mengambil nilai harga kamar
        $kodKamar = $request->get('kode_kamar');
        $tarif="";
        $data = Kamar::where('kode_kamar',$request->get('kode_kamar'))->first();
        if(!empty($data)){
            $statuskamar = $data->Status;
            $tarif = $data->Tarif;
        }
        if($statuskamar == "Kosong"){
        $lamnginap = $request->get('lama_nginap');
        $totalharga = $lamnginap * $tarif;
            Transaksi::insert([
                'nik_pengunjung' => $request->get('nik_pengunjung'),
                'id_karyawan' => $request->get('id_karyawan'),
                'kode_kamar' => $request->get('kode_kamar'),
                'lama_nginap' => $request->get('lama_nginap'),
                'harga' => $totalharga
            ]);

            // merubah status kamar
            Kamar::where('kode_kamar', $kodKamar)
            ->update([
                'Status' => 'Sudah Di Isi'
            ]);

            return response()->json(['message' => 'Pemesanan berhasil']);
        }else {
            return response()->json(['message' => 'Kamar yang di pesan tidak kosong, silahkan pilih kamar yang lain']);
        }
    }
        return response()->json(['message' => 'Data Gagal Di Tambahkan!!,pastikan mengisi semua data!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($transaksi)
    {
        $data = Transaksi::where('no_transaksi',$transaksi)->with('pengunjung','kamar','karyawan')->first();
        if(!empty($data)){
            return $data;
        }
        return response()->json(['message' => 'Data Tidak Di Temukan'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $transaksi)
    {
        $data = Transaksi::where('no_transaksi',$transaksi)->first();
        if(!empty($data)){
            // validasi pemesanan kamar
        $validator = Validator::make($request->all(), [ 
            'nik_pengunjung' => 'required',
            'id_karyawan' => 'required',
            'kode_kamar' => 'required',
            'lama_nginap' => 'required',
        ]);
        
        if($validator->passes()){
            // mengambil nilai harga kamar
        $kodKamar = $request->get('kode_kamar');
        $harga = 0;
        if ($kodKamar == 1) {
            $harga = 150000;
        }elseif($kodKamar == 2){
            $harga = 100000;
        }else {
            $harga = 80000;
        }
        $lamnginap = $request->get('lama_nginap');
        $totalharga = $lamnginap * $harga;
        
        Transaksi::where('no_transaksi', $transaksi)
            ->update([
                'nik_pengunjung' => $request->get('nik_pengunjung'),
                'id_karyawan' => $request->get('id_karyawan'),
                'kode_kamar' => $request->get('kode_kamar'),
                'lama_nginap' => $request->get('lama_nginap'),
                'harga' => $totalharga
            ]);

            return response()->json(['message' => 'Update Pemesanan Berhasil']);
        }
     }
     return response()->json(['message' => 'Data Tidak di temukan!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($transaksi)
    {
        $data = Transaksi::where('no_transaksi', $transaksi)->first();
        if(empty($data)){
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        $data->delete();
        return response()->json([
            'message' => 'Data berhasil di hapus'
        ]);
    }
}
