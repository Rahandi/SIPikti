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

Route::group(['prefix' => 'pendaftaran'], function () {
    Route::get('/', 'HomeController@index')->name('pendaftaran');
    Route::get('/detail2/{id}', 'HomeController@detail2')->name('detail2');
    Route::get('/kwitansi/{id}', 'HomeController@kwitansi')->name('kwitansi');
    Route::get('/detail/{id}', 'HomeController@detail')->name('detail');
    Route::get('/edit/{id}', 'HomeController@edit')->name('edit');
    Route::get('/download', 'HomeController@download')->name('pendaftaran.download');

    Route::post('/update', 'HomeController@update')->name('edit.update');
    Route::post('/verif', 'HomeController@verifikasi')->name('verif');
    Route::post('/delete', 'HomeController@deletePendaftar')->name('delete');
    Route::post('/accept_mahasiswa', 'HomeController@acceptToMahasiswa')->name('accept_mahasiswa');
});


Route::group(['prefix' => 'akademik'], function () {
    Route::group(['prefix' => 'calon_mahasiswa'], function () {
        Route::get('/', 'MahasiswaController@calon_mahasiswa')->name('calon_mahasiswa');
        Route::get('/detail/{id}', 'MahasiswaController@calon_mahasiswa_detail')->name('calon_mahasiswa.detail');
        Route::get('/edit/{id}', 'MahasiswaController@calon_mahasiswa_edit')->name('calon_mahasiswa.edit');

        Route::post('/update', 'MahasiswaController@calon_mahasiswa_update')->name('calon_mahasiswa.update');
        Route::post('/delete', 'MahasiswaController@calon_mahasiswa_delete')->name('calon_mahasiswa.delete');
    });
    Route::group(['prefix' => 'mahasiswa'], function () {
        Route::get('/', 'MahasiswaController@index')->name('mahasiswa');
        Route::get('/detail/{id}', 'MahasiswaController@detail')->name('mahasiswa.detail');
        Route::get('/edit/{id}', 'MahasiswaController@edit')->name('mahasiswa.edit');

        Route::post('/update', 'MahasiswaController@update')->name('mahasiswa.update');
        Route::post('/delete', 'MahasiswaController@delete')->name('mahasiswa.delete');
    });
    Route::group(['prefix' => 'jadwal'], function () {
        Route::get('/', 'JadwalController@index')->name('jadwal');
        Route::get('/create', 'JadwalController@create')->name('jadwal.create');
        Route::get('/edit/{id}', 'JadwalController@edit')->name('jadwal.edit');
        Route::get('/detail/{id}', 'JadwalController@detail')->name('jadwal.detail');
        Route::get('/pilihkelas/{id}', 'JadwalController@PageSelectJadwal')->name('jadwal.pilihkelas');
        Route::get('/absensi/{id}', 'JadwalController@absensi')->name('jadwal.absensi');
        Route::get('/pilihmhs/{id}', 'JadwalController@pilihmhs')->name('jadwal.pilihmhs');
        Route::get('/download/{id_jadwal}/{id_mk}', 'JadwalController@DownloadJadwal')->name('jadwal.download');

        Route::post('/store', 'JadwalController@store')->name('jadwal.store');
        Route::post('/update', 'JadwalController@update')->name('jadwal.update');
        Route::post('/delete', 'JadwalController@delete')->name('jadwal.delete');
        Route::post('/cancel', 'JadwalController@cancel')->name('jadwal.cancel');
        Route::post('/select', 'JadwalController@SelectJadwal')->name('jadwal.select');
        Route::post('/tambah', 'JadwalController@tambah')->name('jadwal.tambah');
    });

    Route::group(['prefix' => 'nilai'], function () {
        Route::get('/', 'PenilaianController@index')->name('penilaian');

        Route::post('/store', 'PenilaianController@store')->name('penilaian.store');
    });
});

Route::group(['prefix' => 'keuangan'], function () {
    Route::get('/angsuran', 'AngsuranController@index')->name('angsuran');
    Route::get('/angsuran/create', 'AngsuranController@create')->name('angsuran.create');
    Route::get('/angsuran/edit/{id}', 'AngsuranController@edit')->name('angsuran.edit');
    Route::get('/pembayaran', 'PembayaranController@index')->name('pembayaran');
    Route::get('/pembayaran/detail/{id}', 'PembayaranController@detail')->name('pembayaran.detail');
    Route::get('/rekap', 'PembayaranController@rekap')->name('pembayaran.rekap');
    Route::get('/rekap/download', 'PembayaranController@download')->name('pembayaran.rekap.download');

    Route::post('/angsuran/store', 'AngsuranController@store')->name('angsuran.store');
    Route::post('/angsuran/update', 'AngsuranController@update')->name('angsuran.update');
    Route::post('/angsuran/delete', 'AngsuranController@delete')->name('angsuran.delete');
    Route::post('/pembayaran/select', 'PembayaranController@selectAngsuran')->name('pembayaran.select');
    Route::post('/pembayaran/bayar', 'PembayaranController@bayarAngsuran')->name('pembayaran.bayar');
    Route::post('/pembayaran/batalbayar', 'PembayaranController@deleteBayarAngsuran')->name('pembayaran.batalbayar');
    Route::post('/pembayaran/kwitansi', 'PembayaranController@kwitansi')->name('pembayaran.kwitansi');
});

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
    Route::group(['prefix'=>'gelombang'], function(){
        Route::get('/', 'MasterController@index_gelombang')->name('master.gelombang.index');
        Route::get('/create', 'MasterController@create_gelombang')->name('master.gelombang.create');
        Route::get('/edit/{id}', 'MasterController@edit_gelombang')->name('master.gelombang.edit');

        Route::post('/store', 'MasterController@store_gelombang')->name('master.gelombang.store');
        Route::post('/update', 'MasterController@update_gelombang')->name('master.gelombang.update');
        Route::post('/delete', 'MasterController@delete_gelombang')->name('master.gelombang.delete');
    });
});

// unrelevant
Route::get('/coba', 'HomeController@generateNoPendaftaran');
Route::get('/updategelombang', 'MahasiswaController@update_gelombang');
Route::post('/daftaroke','PendaftarController@storekhusus');

Auth::routes();