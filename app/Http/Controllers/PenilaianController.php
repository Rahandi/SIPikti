<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;

use App\nilai;
use App\jadwal;
use App\mahasiswa;
use App\masterNilai;
use App\masterKelas;
use App\masterMK;
use App\masterDosen;
use App\masterAsisten;

use App\Exports\NilaiExport;
use App\Exports\NilaiAkhirExport;

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
            $nilai = nilai::where('id_master_nilai', $row->id)->first();

            $jadwal = jadwal::find($row->id_jadwal);

            $temp = new \stdClass();
            $temp->id = $row->id;
            $temp->id_kelas = $jadwal->id_kelas;
            $temp->id_mk = $row->id_mk;
            $temp->termin = $row->termin;
            $temp->kelas = masterKelas::find($jadwal->id_kelas)->nama;
            $temp->mata_kuliah = masterMK::find($row->id_mk)->nama;
            $temp->jml = $row->jumlah_penilaian;
            $temp->exist = ($nilai) ? True : False;

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

        $filename = $termin . '_' . $kelas . '_' . $mk . '.xlsx';
        $filename = preg_replace('/[^a-zA-Z0-9_ .]/', '', $filename);
        return Excel::download(new NilaiExport($request->id), $filename);
    }

    public function upload(Request $request)
    {
        libxml_disable_entity_loader(false);
        $master_nilai = masterNilai::find($request->id);
        $master_nilai->nama_penilaian = explode(',', $master_nilai->nama_penilaian);
        $master_nilai->persen_penilaian = explode(',', $master_nilai->persen_penilaian);
        $jadwal = jadwal::find($master_nilai->id_jadwal);

        $termin = $master_nilai->termin;
        $kelas = masterKelas::find($jadwal->id_kelas)->nama;
        $matkul = masterMK::find($master_nilai->id_mk)->nama;
        $file = $request->file('nilai');
        if(!$file){
            return redirect()->back()->with("status", "Tidak ada file yang di upload");
        }
        $extension = $file->getClientOriginalExtension();
        $filename = $termin . '_' . $kelas . '_' . $matkul . '.' . $extension;
        $filename = preg_replace('/[^a-zA-Z0-9_ .]/', '', $filename);

        if($filename != $file->getClientOriginalName())
        {
            return redirect()->back()->with("status", "File salah");
        }

        $path = \storage_path('nilai');
        $file->move($path, $filename);
        $filepath = \storage_path('nilai/' . $filename);

        $data = (new FastExcel)->import($filepath);
        $name = [];
        $persen = [];
        for ($i=0; $i < $master_nilai->jumlah_penilaian; $i++) {
            $nama = $master_nilai->nama_penilaian[$i] . ' ' . '(' . $master_nilai->persen_penilaian[$i] . '%)';
            array_push($name, $nama);
            array_push($persen, $master_nilai->persen_penilaian[$i]);
        }

        foreach ($data as $row) {
            $mahasiswa = mahasiswa::where('nrp', strval($row['NRP']))->get()->first();
            
            $nilai_total = 0;
            $satuan = [];
            for ($i=0; $i < count($name); $i++) {
                $row[$name[$i]] = ($row[$name[$i]])?$row[$name[$i]]:0;
                array_push($satuan, $row[$name[$i]]);
                $nilai_total += $row[$name[$i]] * $persen[$i] / 100.0;
            }

            $nilai = nilai::findOrCreate($request->id, $mahasiswa->id);
            $nilai->id_master_nilai = $request->id;
            $nilai->id_mahasiswa = $mahasiswa->id;
            $nilai->nilai = implode(',', $satuan);
            $nilai->nilai_total = $nilai_total;
            $nilai->save();
        }

        return redirect()->back()->with("status", "Upload Berhasil");
    }

    public function delete(Request $request)
    {
        $master_nilai = masterNilai::find($request->id);
        $master_nilai->delete();

        $nilais = nilai::where('id_master_nilai', $request->id)->get();
        foreach ($nilais as $nilai ) {
            $nilai->delete();
        }

        return redirect()->back();
    }

    public function nilai_total(Request $request)
    {
        $master_nilai = masterNilai::find($request->id);
        $jadwal = jadwal::find($master_nilai->id_jadwal);

        $termin = $master_nilai->termin;
        $kelas = masterKelas::find($jadwal->id_kelas)->nama;
        $mk = masterMK::find($master_nilai->id_mk)->nama;

        $filename = $termin . '_' . $kelas . '_' . $mk . '_nilai_akhir' . '.xlsx';
        $filename = preg_replace('/[^a-zA-Z0-9_ .]/', '', $filename);
        return Excel::download(new NilaiAkhirExport($request->id), $filename);
    }
}
