<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mahasiswa;

class TogaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = mahasiswa::all();
        return view('keuangan.toga.index', compact('data'));
    }

    public function kwitansi(Request $request)
    {
        $mahasiswa = mahasiswa::find($request->id);
        return view ('keuangan.toga.kwitansi', compact('data'));
    }
}
