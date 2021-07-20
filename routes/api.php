<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Pengunjung
Route::get('/beranda/pengunjung','PengunjungController@index')->middleware('auth:api');
Route::get('/beranda/pengunjung/{pengunjung}','PengunjungController@show');
Route::post('/beranda/pengunjung/','PengunjungController@store');
Route::delete('/beranda/pengunjung/{pengunjung}','PengunjungController@destroy')->middleware('auth:api');
Route::patch('/beranda/pengunjung/{pengunjung}','PengunjungController@update');


// Karyawan
Route::get('/admin/karyawan','KaryawanController@index');
Route::get('/admin/karyawan/{karyawan}','KaryawanController@show');
Route::post('/admin/karyawan/','KaryawanController@store');
Route::patch('/admin/karyawan/{karyawan}','KaryawanController@update');
Route::delete('/admin/karyawan/{karyawan}','KaryawanController@destroy');

// Jenis Kamar
Route::get('/admin/jenis_kamar','JenisKamarController@index');
Route::get('/admin/jenis_kamar/{jeniskamar}','JenisKamarController@show');
Route::post('/admin/jenis_kamar/','JenisKamarController@store');
Route::patch('/admin/jenis_kamar/{jeniskamar}','JenisKamarController@update');
Route::delete('/admin/jenis_kamar/{jeniskamar}','JenisKamarController@destroy');

// Kamar
Route::get('/admin/kamar','KamarController@index');
Route::get('/admin/kamar/{kamar}','KamarController@show');
Route::post('/admin/kamar/','KamarController@store');
Route::patch('/admin/kamar/{kamar}','KamarController@update');
Route::delete('/admin/kamar/{kamar}','KamarController@destroy');

// Transaksi pemesanan kamar
Route::get('/admin/transaksi','TransaksiController@index');
Route::get('/admin/transaksi/{transaksi}','TransaksiController@show');
Route::post('/admin/transaksi/','TransaksiController@store');
Route::delete('/admin/transaksi/{transaksi}','TransaksiController@destroy');
Route::patch('/admin/transaksi/{transaksi}','TransaksiController@update');

// get pass ecry
Route::get('password', function(){
    return bcrypt('bale');
});
// Auth Login
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});