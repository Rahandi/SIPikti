<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mahasiswa;
use App\mahasiswaJadwal;
use App\jadwal;
use App\masterKelas;

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
        $mahasiswaJadwal = mahasiswaJadwal::where('mahasiswa_id', $request->id)->first();
        $jadwal = jadwal::find($mahasiswaJadwal->jadwal_id);
        $kelas = masterKelas::find($jadwal->id_kelas);

        $data = new \strClass();
        $data->mahasiswa = $mahasiswa->nama;
        $data->kelas = $kelas->nama;
        return view ('keuangan.toga.kwitansi', compact('data'));
    }
}
