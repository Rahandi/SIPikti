<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// authorized
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/pendaftaran/kwitansi/{id}', 'HomeController@kwitansi')->name('kwitansi');
Route::get('/pendaftaran/detail/{id}', 'HomeController@detail')->name('detail');
Route::get('/pendaftaran/edit/{id}', 'HomeController@edit')->name('edit');
Route::post('/pendaftaran/update', 'HomeController@update')->name('edit.update');
Route::post('/pendaftaran/verif', 'HomeController@verifikasi')->name('verif');
Route::post('/pendaftaran/delete', 'HomeController@deletePendaftar')->name('delete');

// public
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/pendaftaran', 'HomeController@test')->name('pendaftaran');
Route::get('/pendaftaran/detail2/{id}', 'HomeController@detail2')->name('detail2');
Route::get('/angsuran', 'HomeController@test2')->name('angsuran');
Route::get('/mahasiswa', 'HomeController@test3')->name('mahasiswa');

Route::get('/daftar', 'PendaftarController@create')->name('daftar');
Route::get('/coba', 'PendaftarController@generateNoPendaftaran');
Route::post('/daftar', 'PendaftarController@store')->name('daftar.store');

Route::get('/test_dashboard', 'HomeController@test')->name('test_dashboard');
Route::post('/accept_mahasiswa', 'HomeController@acceptToMahasiswa')->name('accept_mahasiswa');

Route::get('/akademik/calon_mahasiswa', 'MahasiswaController@calon_mahasiswa')->name('calon_mahasiswa');
Route::get('/akademik/calon_mahasiswa/detail/{id}', 'MahasiswaController@calon_mahasiswa_detail')->name('calon_mahasiswa.detail');
Route::get('/akademik/calon_mahasiswa/edit/{id}', 'MahasiswaController@calon_mahasiswa_edit')->name('calon_mahasiswa.edit');
Route::post('/akademik/calon_mahasiswa/update', 'MahasiswaController@calon_mahasiswa_update')->name('calon_mahasiswa.update');
Route::post('/akademik/calon_mahasiswa/delete', 'MahasiswaController@calon_mahasiswa_delete')->name('calon_mahasiswa.delete');

Route::get('/akademik/mahasiswa', 'MahasiswaController@index')->name('mahasiswa');
Route::get('/akademik/mahasiswa/detail/{id}', 'MahasiswaController@detail')->name('mahasiswa.detail');
Route::get('/akademik/mahasiswa/edit/{id}', 'MahasiswaController@edit')->name('mahasiswa.edit');
Route::post('/akademik/mahasiswa/update', 'MahasiswaController@update')->name('mahasiswa.update');
Route::post('/akademik/mahasiswa/delete', 'MahasiswaController@delete')->name('mahasiswa.delete');

Route::get('/keuangan/angsuran', 'AngsuranController@index')->name('angsuran');
Route::get('/keuangan/angsuran/create', 'AngsuranController@create')->name('angsuran.create');
Route::post('/keuangan/angsuran/store', 'AngsuranController@store')->name('angsuran.store');
Route::get('/keuangan/angsuran/edit/{id}', 'AngsuranController@edit')->name('angsuran.edit');
Route::post('/keuangan/angsuran/update', 'AngsuranController@update')->name('angsuran.update');
Route::post('/keuangan/angsuran/delete', 'AngsuranController@delete')->name('angsuran.delete');

Route::get('/keuangan/pembayaran', 'PembayaranController@index')->name('pembayaran');
Route::get('/keuangan/pembayaran/detail/{id}', 'PembayaranController@detail')->name('pembayaran.detail');
Route::get('/keuangan/pembayaran/rekap', 'PembayaranController@rekap')->name('pembayaran.rekap');
Route::get('/keuangan/pembayaran/rekap/download', 'PembayaranController@download')->name('pembayaran.rekap.download');
Route::post('/keuangan/pembayaran/select', 'PembayaranController@selectAngsuran')->name('pembayaran.select');
Route::post('/keuangan/pembayaran/bayar', 'PembayaranController@bayarAngsuran')->name('pembayaran.bayar');
Route::post('/keuangan/pembayaran/kwitansi', 'PembayaranController@kwitansi')->name('pembayaran.kwitansi');

Route::get('/coba', 'PembayaranController@download');

Auth::routes();