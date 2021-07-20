<?php

namespace App\Http\Controllers;

use App\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengunjung::all();
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
        $validator = Validator::make($request->all(), [ 
            'nik' => 'required',
            'nama_pengunjung' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'no_telpon' => 'required',
        ]);
        if($validator->passes()){
            return Pengunjung::create($request->all());
        }
        return response()->json(['message' => 'Data Gagal Di Tambahkan!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function show($pengunjung)
    {
        $data = Pengunjung::where('nik',$pengunjung)->first();
        if(!empty($data)){
            return $data;
        }
        return response()->json(['message' => 'Data Tidak Di Temukan'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengunjung $pengunjung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pengunjung)
    {
        $data = Pengunjung::where('nik',$pengunjung)->first();
        if(!empty($data)){
            $validator = Validator::make($request->all(), [ 
                'nik' => 'required',
                'nama_pengunjung' => 'required',
                'alamat' => 'required',
                'jenis_kelamin' => 'required',
                'no_telpon' => 'required',
            ]);
            if($validator->passes()){
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Berhasil Di simpan',
                    'data' => $data
                ]);
            }else{
                return response()->json([
                    'message' => 'Data gagl di simpan',
                    'data' => $validator->errors()->all()
                ]);
            }
        }
        return response()->json(['message' => 'Data Tidak di temukan!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function destroy($pengunjung)
    {
        $data = Pengunjung::where('nik', $pengunjung)->first();
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
