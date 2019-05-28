<?php

namespace App\Http\Controllers;

use App\mahasiswa;
use App\angsuran;
use App\mahasiswaAngsuran;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = mahasiswa::all();
        return view('mahasiswa', compact('data'));
    }

    public function delete(Request $request)
    {
        $data = mahasiswa::find($request->id);
        $data->delete();
        return redirect()->back();
    }
}
