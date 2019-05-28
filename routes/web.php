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
Route::get('/kwitansi/{id}', 'HomeController@kwitansi')->name('kwitansi');
Route::get('/detail/{id}', 'HomeController@detail')->name('detail');
Route::get('/edit/{id}', 'HomeController@edit')->name('edit');
Route::post('/update', 'HomeController@update')->name('edit.update');
Route::post('/verif', 'HomeController@verifikasi')->name('verif');
Route::post('/delete', 'HomeController@deletePendaftar')->name('delete');

// public
Route::get('/', function () {
    return view('homepage');
})->name('homepage');
Route::get('/dashboard2', function () {
    return view('dashboard2');
})->name('dashboard2');

Route::get('/pendaftaran', 'HomeController@test')->name('pendaftaran');
Route::get('/detail2/{id}', 'HomeController@detail2')->name('detail2');
Route::get('/angsuran', 'HomeController@test2')->name('angsuran');
Route::get('/mahasiswa', 'HomeController@test3')->name('mahasiswa');

Route::get('/akademik', function () {
    return view('akademik');
})->name('akademik');
Route::get('/pembayaran', function () {
    return view('pembayaran');
})->name('pembayaran');
Route::get('/daftar', 'PendaftarController@create')->name('daftar');
Route::get('/coba', 'PendaftarController@generateNoPendaftaran');
Route::post('/daftar', 'PendaftarController@store')->name('daftar.store');

Auth::routes();