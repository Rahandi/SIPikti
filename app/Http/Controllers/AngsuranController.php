<?php

namespace App\Http\Controllers;

use App\angsuran;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = angsuran::all();
        return view('angsuran', compact('data'));
    }

    public function tambah_angsuran(Request $request)
    {
        $angsuran = new angsuran();
        $angsuran->nama = $request->nama;
        $angsuran->gelombang = $request->gelombang;
        $angsuran->detail = $request->detail;
        $angsuran->kali_pembayaran = $request->kali_pembayaran;
        $angsuran->save();
    }
}
