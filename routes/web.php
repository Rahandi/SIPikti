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

Route::get('/daftar', 'PendaftarController@create')->name('daftar');
Route::post('/daftar', 'PendaftarController@store')->name('daftar.store');
Route::get('/show/{id}', 'PendaftarController@show')->name('show');
Route::get('/kwitansi/{id}', 'PendaftarController@kwitansi')->name('contoh');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
