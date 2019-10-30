<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\nilai;
use App\jadwal;
use App\masterNilai;
use App\masterKelas;
use App\masterMK;
use App\masterDosen;
use App\masterAsisten;

class PenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = array();
        $jadwal = jadwal::all();
        foreach ($jadwal as $item)
        {
            $temp = new \stdClass();
            $temp->id = $item->id;
            $temp->termin = $item->termin;
            $temp->kelas = masterKelas::find($item->id_kelas)->nama;
            $temp->mk = array();
            $temp->dosen = array();
            $temp->asisten = array();

            $ids_mk = explode(',', $item->ids_mk);
            $ids_dosen = explode(',', $item->ids_dosen);
            $ids_asisten = explode(',', $item->ids_asisten);

            for ($i=0; $i < count($ids_mk) ; $i++) { 
                array_push($temp->mk, masterMK::find($ids_mk[$i])->nama);
                array_push($temp->dosen, masterDosen::find($ids_dosen[$i])->nama);
                array_push($temp->asisten, masterAsisten::find($ids_asisten[$i])->nama);
            }

            array_push($data, $temp);
        }
        return view('akademik.nilai.index', compact('data'));
    }

    public function store(Request $request)
    {
        dd($request);
        $master_nilai = new masterNilai();
        $master_nilai->id_jadwal = $request->id_jadwal;
        $master_nilai->jumlah_penilaian = $request->jumlah_penilaian;
        $master_nilai->nama_penilaian = serialize($request->nama_penilaian);
        $master_nilai->persen_penilaian = serialize($request->persen_penilaian);
        $master_nilai->save();

        return redirect()->back();
    }
}
