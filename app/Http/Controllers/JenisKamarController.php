<?php

namespace App\Http\Controllers;

use App\JenisKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisKamarController extends Controller
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
        $data = JenisKamar::with('kamar')->get();
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
            'Jenis_kamar' => 'required',
        ]);
        if($validator->passes()){
            return JenisKamar::create($request->all());
        }
        return response()->json(['message' => 'Data Gagal Di Tambahkan!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JenisKamar  $jenisKamar
     * @return \Illuminate\Http\Response
     */
    public function show($jenisKamar)
    {
        $data = JenisKamar::where('id_jenis_kamar',$jenisKamar)->first();
        if(!empty($data)){
            return $data;
        }
        return response()->json(['message' => 'Data Tidak Di Temukan'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JenisKamar  $jenisKamar
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisKamar $jenisKamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisKamar  $jenisKamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $jenisKamar)
    {
        $data = JenisKamar::where('id_jenis_kamar',$jenisKamar)->first();
        if(!empty($data)){
            $validator = Validator::make($request->all(), [ 
                'Jenis_kamar' => 'required',
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
     * @param  \App\JenisKamar  $jenisKamar
     * @return \Illuminate\Http\Response
     */
    public function destroy($jenisKamar)
    {
        $data = JenisKamar::where('id_jenis_kamar', $jenisKamar)->first();
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
