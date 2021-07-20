<?php

namespace App\Http\Controllers;

use App\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KamarController extends Controller
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
        $data = Kamar::with('jeniskamar')->get();
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
            'Tarif' => 'required',
            'Jenis_kamar' => 'required',
            'Status' => 'required',
            'Nama_kamar' => 'required',
        ]);
        if($validator->passes()){
            return Kamar::create($request->all());
        }
        return response()->json(['message' => 'Data Gagal Di Tambahkan!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function show($kamar)
    {
        $data = Kamar::where('kode_kamar',$kamar)->with('jeniskamar')->first();
        if(!empty($data)){
            return $data;
        }
        return response()->json(['message' => 'Data Tidak Di Temukan'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit(Kamar $kamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kamar)
    {
        $data = Kamar::where('kode_kamar',$kamar)->first();
        if(!empty($data)){
            $validator = Validator::make($request->all(), [ 
                'Tarif' => 'required',
            'Jenis_kamar' => 'required',
            'Status' => 'required',
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
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy($kamar)
    {
        $data = Kamar::where('kode_kamar', $kamar)->first();
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
