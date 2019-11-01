<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;

use App\nilai;
use App\jadwal;
use App\masterNilai;
use App\masterKelas;
use App\masterMK;
use App\masterDosen;
use App\masterAsisten;

use App\Exports\NilaiExport;

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

        $list = array();
        $master_nilai = masterNilai::all();
        foreach($master_nilai as $row)
        {
            $jadwal = jadwal::find($row->id_jadwal);

            $temp = new \stdClass();
            $temp->id = $row->id;
            $temp->termin = $row->termin;
            $temp->kelas = masterKelas::find($jadwal->id_kelas)->nama;
            $temp->mata_kuliah = masterMK::find($row->id_mk)->nama;
            $temp->jml = $row->jumlah_penilaian;

            array_push($list, $temp);

        }
        return view('akademik.nilai.index', ['data' => $data, 'list' => $list]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $master_nilai = new masterNilai();

        $kelas = explode(',', $request->kelas);

        $master_nilai->termin = $kelas[0];
        $master_nilai->id_jadwal = $kelas[1];
        $master_nilai->jumlah_penilaian = $request->jml;
        $master_nilai->nama_penilaian = implode(',', $request->nama_penilaian);
        $master_nilai->persen_penilaian = implode(',', $request->prosentase);

        $jadwal = jadwal::find($master_nilai->id_jadwal);
        $master_nilai->id_mk = explode(',',$jadwal->ids_mk)[$kelas[2]];

        $master_nilai->save();

        return redirect()->back();
    }

    public function download(Request $request)
    {
        $master_nilai = masterNilai::find($request->id);
        $jadwal = jadwal::find($master_nilai->id_jadwal);

        $termin = $master_nilai->termin;
        $kelas = masterKelas::find($jadwal->id_kelas)->nama;
        $mk = masterMK::find($master_nilai->id_mk)->nama;

        return Excel::download(new NilaiExport($request->id), $termin . ' ' . $kelas . ' ' . $mk . '.xlsx');
    }

    public function upload(Request $request)
    {
        $file = $request->file('nilai');

        $data = (new FastExcel)->import();   
    }
}
