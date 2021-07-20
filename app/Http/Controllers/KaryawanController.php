<?php

namespace App\Http\Controllers;

use App\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  cek login
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = Karyawan::all();
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
            'nama_karyawan' => 'required',
            'jenis_kelamin' => 'required',
        ]);
        if($validator->passes()){
            return Karyawan::create($request->all());
        }
        return response()->json(['message' => 'Data Gagal Di Tambahkan!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show($karyawan)
    {
        $data = Karyawan::where('id_karyawan',$karyawan)->first();
        if(!empty($data)){
            return $data;
        }
        return response()->json(['message' => 'Data Tidak Di Temukan'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $karyawan)
    {
        $data = Karyawan::where('id_karyawan',$karyawan)->first();
        if(!empty($data)){
            $validator = Validator::make($request->all(), [ 
                'nama_karyawan' => 'required',
                'jenis_kelamin' => 'required',
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
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($karyawan)
    {
        $data = Karyawan::where('id_karyawan', $karyawan)->first();
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
