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
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/list', 'HomeController@list')->name('list');
Route::get('/kwitansi/{id}', 'HomeController@kwitansi')->name('kwitansi');
Route::get('/detail/{id}', 'HomeController@detail')->name('detail');
Route::get('/edit/{id}', 'HomeController@edit')->name('edit');
Route::post('/update', 'HomeController@update')->name('edit.update');
Route::post('/verif', 'HomeController@verifikasi')->name('verif');
Route::post('/delete', 'HomeController@deletePendaftar')->name('delete');

// public
Route::get('/', function () {
    return view('homepage');
});
Route::get('/daftar', 'PendaftarController@create')->name('daftar');
Route::get('/coba', 'PendaftarController@generateNoPendaftaran');
Route::post('/daftar', 'PendaftarController@store')->name('daftar.store');

Auth::routes();