<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mahasiswa;
use App\nilai;
use App\masterNilai;

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
        $return_nilai = array();
        foreach ($nilais as $nilai) {
            $id_master_nilai = $nilai->id_master_nilai;
            $master_nilai = masterNilai::find($id_master_nilai);
            $detail_nilai = explode(',', $nilai->nilai);
            
        }
    }
}
