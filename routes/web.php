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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/list', 'PendaftarController@index')->name('list');
Route::get('/daftar', 'PendaftarController@create')->name('daftar');
Route::get('/edit/{id}', 'PendaftarController@edit')->name('edit');
Route::get('/detail/{id}', 'PendaftarController@show')->name('show');
Route::get('/kwitansi/{id}', 'PendaftarController@kwitansi')->name('contoh');
Route::get('/coba', 'PendaftarController@generateNoPendaftaran');

Route::post('/daftar', 'PendaftarController@store')->name('daftar.store');
Route::post('/edit/{id}', 'PendaftarController@update')->name('edit.update');
Route::post('/verif', 'PendaftarController@verifikasiPendaftar')->name('verif');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
