<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mahasiswa;
use App\nilai;
use App\masterNilai;
use App\masterMK;

class TranskripController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = mahasiswa::all();
        return view('akademik.transkrip.index', compac('data'));
    }

    public function download(Request $request)
    {
        $nilais = nilai::where('id_mahasiswa', $request->id)->get();
        $return_nilai = new \stdClass();
        $return_nilai->nilai = array();
        $total = 0;
        $hitung = 0;
        foreach ($nilais as $nilai) {
            $id_master_nilai = $nilai->id_master_nilai;
            $master_nilai = masterNilai::find($id_master_nilai);
            $master_mk = masterMK::find($master_nilai->id_mk);
            $temp = new \stdClass();
            $temp->nama = $master_mk->nama;
            $temp->semester = $master_nilai->termin;
            $temp->sks = $master_mk->sks;
            $temp->nilai = ($nilai->nilai_total / 100.0) * 4;
            array_push($return_nilai->nilai, $temp);
            $total += $temp->nilai;
            $hitung += 1;
        }
    }
}
