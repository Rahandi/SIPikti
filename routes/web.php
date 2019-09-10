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

// public
Route::get('/', function () {
    return view('homepage');
})->name('homepage');
Route::get('/daftar', 'PendaftarController@create')->name('daftar');
Route::post('/daftar', 'PendaftarController@store')->name('daftar.store');

// authorized
Route::get('/dashboard', 'HomeController@statistic')->name('dashboard');
Route::get('/pendaftaran', 'HomeController@index')->name('pendaftaran');
Route::get('/pendaftaran/detail2/{id}', 'HomeController@detail2')->name('detail2');
Route::get('/pendaftaran/kwitansi/{id}', 'HomeController@kwitansi')->name('kwitansi');
Route::get('/pendaftaran/detail/{id}', 'HomeController@detail')->name('detail');
Route::get('/pendaftaran/edit/{id}', 'HomeController@edit')->name('edit');
Route::post('/pendaftaran/update', 'HomeController@update')->name('edit.update');
Route::post('/pendaftaran/verif', 'HomeController@verifikasi')->name('verif');
Route::post('/pendaftaran/delete', 'HomeController@deletePendaftar')->name('delete');
Route::post('/pendaftaran/accept_mahasiswa', 'HomeController@acceptToMahasiswa')->name('accept_mahasiswa');
Route::get('/pendaftaran/download', 'HomeController@download')->name('pendaftaran.download');

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

Route::get('/akademik/jadwal', 'JadwalController@index')->name('jadwal');
Route::get('/akademik/jadwal/create', 'JadwalController@create')->name('jadwal.create');
Route::get('/akademik/jadwal/edit/{id}', 'JadwalController@edit')->name('jadwal.edit');
Route::get('/akademik/jadwal/detail/{id}', 'JadwalController@detail')->name('jadwal.detail');
Route::get('/akademik/jadwal/pilihkelas/{id}', 'JadwalController@PageSelectJadwal')->name('jadwal.pilihkelas');
Route::get('/akademik/jadwal/absensi/{id}', 'JadwalController@absensi')->name('jadwal.absensi');
Route::post('/akademik/jadwal/store', 'JadwalController@store')->name('jadwal.store');
Route::post('/akademik/jadwal/update', 'JadwalController@update')->name('jadwal.update');
Route::post('/akademik/jadwal/delete', 'JadwalController@delete')->name('jadwal.delete');
Route::post('/akademik/jadwal/cancel', 'JadwalController@cancel')->name('jadwal.cancel');
Route::post('/akademik/jadwal/select', 'JadwalController@SelectJadwal')->name('jadwal.select');

Route::get('/keuangan/angsuran', 'AngsuranController@index')->name('angsuran');
Route::get('/keuangan/angsuran/create', 'AngsuranController@create')->name('angsuran.create');
Route::get('/keuangan/angsuran/edit/{id}', 'AngsuranController@edit')->name('angsuran.edit');
Route::post('/keuangan/angsuran/store', 'AngsuranController@store')->name('angsuran.store');
Route::post('/keuangan/angsuran/update', 'AngsuranController@update')->name('angsuran.update');
Route::post('/keuangan/angsuran/delete', 'AngsuranController@delete')->name('angsuran.delete');

Route::get('/keuangan/pembayaran', 'PembayaranController@index')->name('pembayaran');
Route::get('/keuangan/pembayaran/detail/{id}', 'PembayaranController@detail')->name('pembayaran.detail');
Route::get('/keuangan/rekap', 'PembayaranController@rekap')->name('pembayaran.rekap');
Route::get('/keuangan/rekap/download', 'PembayaranController@download')->name('pembayaran.rekap.download');
Route::post('/keuangan/pembayaran/select', 'PembayaranController@selectAngsuran')->name('pembayaran.select');
Route::post('/keuangan/pembayaran/bayar', 'PembayaranController@bayarAngsuran')->name('pembayaran.bayar');
Route::post('/keuangan/pembayaran/batalbayar', 'PembayaranController@deleteBayarAngsuran')->name('pembayaran.batalbayar');
Route::post('/keuangan/pembayaran/kwitansi', 'PembayaranController@kwitansi')->name('pembayaran.kwitansi');

Route::group(['prefix'=>'master'], function(){
    Route::group(['prefix'=>'asisten'], function(){
        Route::get('/', 'MasterController@index_asisten')->name('master.asisten.index');
        Route::get('/create', 'MasterController@create_asisten')->name('master.asisten.create');
        Route::get('/edit/{id}', 'MasterController@edit_asisten')->name('master.asisten.edit');
        Route::post('/store', 'MasterController@store_asisten')->name('master.asisten.store');
        Route::post('/update', 'MasterController@update_asisten')->name('master.asisten.update');
        Route::post('/delete', 'MasterController@delete_asisten')->name('master.asisten.delete');
    });
    Route::group(['prefix'=>'dosen'], function(){
        Route::get('/', 'MasterController@index_dosen')->name('master.dosen.index');
        Route::get('/create', 'MasterController@create_dosen')->name('master.dosen.create');
        Route::get('/edit/{id}', 'MasterController@edit_dosen')->name('master.dosen.edit');
        Route::post('/store', 'MasterController@store_dosen')->name('master.dosen.store');
        Route::post('/update', 'MasterController@update_dosen')->name('master.dosen.update');
        Route::post('/delete', 'MasterController@delete_dosen')->name('master.dosen.delete');
    });
    Route::group(['prefix'=>'kelas'], function(){
        Route::get('/', 'MasterController@index_kelas')->name('master.kelas.index');
        Route::get('/create', 'MasterController@create_kelas')->name('master.kelas.create');
        Route::get('/edit/{id}', 'MasterController@edit_kelas')->name('master.kelas.edit');
        Route::post('/store', 'MasterController@store_kelas')->name('master.kelas.store');
        Route::post('/update', 'MasterController@update_kelas')->name('master.kelas.update');
        Route::post('/delete', 'MasterController@delete_kelas')->name('master.kelas.delete');
    });
    Route::group(['prefix'=>'mk'], function(){
        Route::get('/', 'MasterController@index_mk')->name('master.mk.index');
        Route::get('/create', 'MasterController@create_mk')->name('master.mk.create');
        Route::get('/edit/{id}', 'MasterController@edit_mk')->name('master.mk.edit');
        Route::post('/store', 'MasterController@store_mk')->name('master.mk.store');
        Route::post('/update', 'MasterController@update_mk')->name('master.mk.update');
        Route::post('/delete', 'MasterController@delete_mk')->name('master.mk.delete');
    });
});

// unrelevant
Route::get('/coba', 'HomeController@generateNoPendaftaran');
Route::post('/daftaroke','PendaftarController@storekhusus');

Auth::routes();