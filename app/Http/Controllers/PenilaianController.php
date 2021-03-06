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
use App\mahasiswaJadwal;

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
        $master_nilai = masterNilai::all();
        foreach ($jadwal as $item)
        {
            $temp = new \stdClass();
            $temp->id = $item->id;
            $temp->tahun = $item->tahun;
            $temp->termin = $item->termin;
            $temp->kelas = masterKelas::find($item->id_kelas)->nama;
            $temp->mk = array();
            $temp->dosen = array();
            $temp->asisten = array();

            $ids_mk = explode(',', $item->ids_mk);
            $ids_dosen = explode(',', $item->ids_dosen);
            $ids_asisten = explode(',', $item->ids_asisten);

            for ($i=0; $i < count($ids_mk) ; $i++) { 
                array_push($temp->mk, ($ids_mk[$i])?masterMK::find($ids_mk[$i])->nama:null);
                array_push($temp->dosen, ($ids_dosen[$i])?masterDosen::find($ids_dosen[$i])->nama:null);
                array_push($temp->asisten, ($ids_asisten[$i])?masterAsisten::find($ids_asisten[$i])->nama:null);
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
            $temp->tahun = $jadwal->tahun;
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
        $kelas = explode(',', $request->kelas);
        // dd($kelas);
        $jadwal = jadwal::find($kelas[1]);
        // dd($jadwal);
        $id_mk = explode(',', $jadwal->ids_mk)[$kelas[2]];
        $master_nilai = masterNilai::where('id_jadwal', $kelas[1])->where('id_mk', $id_mk)->first();
        // dd($master_nilai);
        if (!$master_nilai)
        {
            $master_nilai = new masterNilai();

            $master_nilai->termin = $kelas[0];
            $master_nilai->id_jadwal = $kelas[1];
            $master_nilai->jumlah_penilaian = $request->jml;
            $master_nilai->nama_penilaian = implode(',', $request->nama_penilaian);
            $master_nilai->persen_penilaian = implode(',', $request->prosentase);

            $jadwal = jadwal::find($master_nilai->id_jadwal);
            $master_nilai->id_mk = explode(',',$jadwal->ids_mk)[$kelas[2]];

            $master_nilai->save();

            $mhss = mahasiswaJadwal::where('jadwal_id', $jadwal->id)->get();
            $satuan = [];
            for ($i=0; $i < $master_nilai->jumlah_penilaian; $i++) { 
                array_push($satuan, 0);
            }

            foreach ($mhss as $mhs) {
                $nilai = nilai::findOrCreate($master_nilai->id, $mhs->mahasiswa_id);
                $nilai->id_master_nilai = $master_nilai->id;
                $nilai->id_mahasiswa = $mhs->mahasiswa_id;
                $nilai->nilai = implode(',', $satuan);
                $nilai->nilai_total = 0;
                $nilai->save();
            }

            return redirect()->back();
        }
        else
        {
            return redirect()->back()->with("status", "Penilaian Sudah Ada");
        }
    }

    public function download(Request $request)
    {
        $master_nilai = masterNilai::find($request->id);
        $jadwal = jadwal::find($master_nilai->id_jadwal);

        $termin = $master_nilai->termin;
        $kelas = masterKelas::find($jadwal->id_kelas)->nama;
        $mk = masterMK::find($master_nilai->id_mk)->nama;
        $tahun = $jadwal->tahun;

        $filename = $tahun . '_' . $termin . '_' . $kelas . '_' . $mk . '.xlsx';
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
        $tahun = $jadwal->tahun;
        $file = $request->file('nilai');
        if(!$file){
            return redirect()->back()->with("status", "Tidak ada file yang di upload");
        }
        $extension = $file->getClientOriginalExtension();
        $filename = $tahun . '_' . $termin . '_' . $kelas . '_' . $matkul . '.' . $extension;
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

        $return = array();

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

            $temp = new \stdClass();
            $temp->nrp = $mahasiswa->nrp;
            $temp->nama = $mahasiswa->nama;
            $temp->nilai100 = $nilai_total;
            $temp->nilai_huruf = $this->parse_nilai($temp->nilai100);
            $temp->nilai4 = $this->parse_nilai4($temp->nilai_huruf);

            array_push($return, $temp);
        }

        return redirect()->back()->with("status", "Upload Berhasil")->with('data', $return);
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
        $tahun = $jadwal->tahun;

        $termin = $master_nilai->termin;
        $kelas = masterKelas::find($jadwal->id_kelas)->nama;
        $mk = masterMK::find($master_nilai->id_mk)->nama;

        $filename = $tahun . '_' . $termin . '_' . $kelas . '_' . $mk . '_nilai_akhir' . '.xlsx';
        $filename = preg_replace('/[^a-zA-Z0-9_ .]/', '', $filename);
        return Excel::download(new NilaiAkhirExport($request->id), $filename);
    }

    public function detail($id)
    {
        $master_nilai = masterNilai::find($id);
        $nilais = nilai::where('id_master_nilai', $id)->get();
        $jadwal = jadwal::find($master_nilai->id_jadwal);
        $mk = masterMK::find($master_nilai->id_mk);

        $info = new \stdClass();
        $info->id = $id;
        $info->tahun = $jadwal->tahun;
        $info->kelas = masterKelas::find($jadwal->id_kelas)->nama;
        $info->matkul = $mk->nama;
        $info->semester = $jadwal->termin;
        $info->stat_nilai = new \stdClass();

        $info->stat_nilai->total = 0;
        $info->stat_nilai->A = 0;
        $info->stat_nilai->AB = 0;
        $info->stat_nilai->B = 0;
        $info->stat_nilai->BC = 0;
        $info->stat_nilai->C = 0;
        $info->stat_nilai->D = 0;
        $info->stat_nilai->E = 0;

        $name = explode(',',$master_nilai->nama_penilaian);
        $jumlah = intval($master_nilai->jumlah_penilaian);
        $percentage = explode(',',$master_nilai->persen_penilaian);

        $header = [];
        for ($i=0; $i < $jumlah; $i++) { 
            $temp = $name[$i] . ' (' . $percentage[$i] . '%)';
            array_push($header, $temp);
        }

        $data = [];
        foreach($nilais as $nilai)
        {
            $temp = new \stdClass();
            $temp->mahasiswa = mahasiswa::find($nilai->id_mahasiswa);
            $temp->total = number_format((float)$nilai->nilai_total, 2, '.', '');
            $temp->terpisah = explode(',', $nilai->nilai);
            $temp->nilai_huruf = $this->parse_nilai($nilai->nilai_total);
            array_push($data, $temp);

            $info->stat_nilai->total += 1;
            if($temp->nilai_huruf == 'A')
            {
                $info->stat_nilai->A += 1;
            }
            elseif($temp->nilai_huruf == 'AB')
            {
                $info->stat_nilai->AB += 1;
            }
            elseif($temp->nilai_huruf == 'B')
            {
                $info->stat_nilai->B += 1;
            }
            elseif($temp->nilai_huruf == 'BC')
            {
                $info->stat_nilai->BC += 1;
            }
            elseif($temp->nilai_huruf == 'C')
            {
                $info->stat_nilai->C += 1;
            }
            elseif($temp->nilai_huruf == 'D')
            {
                $info->stat_nilai->D += 1;
            }
            elseif($temp->nilai_huruf == 'E')
            {
                $info->stat_nilai->E += 1;
            }
        }

        $info->stat_nilai->total = ($info->stat_nilai->total != 0)?$info->stat_nilai->total:1;

        return view('akademik.nilai.detail', ['info' => $info, 'header' => $header, 'data' => $data]);
    }

    public function detail_submit(Request $request)
    {
        $master_nilai = masterNilai::find($request->id);
        $jumlah_penilaian = intval($master_nilai->jumlah_penilaian);
        $persen_penilaian = explode(',',$master_nilai->persen_penilaian);

        for ($i=0; $i < count($request->id_mhs); $i++) { 
            $mhs = $request->id_mhs[$i];
            
            $total = 0;
            $nilais = [];
            for ($j=0; $j < $jumlah_penilaian; $j++) { 
                array_push($nilais, $request[$mhs.'|'.$j]);
                $total += $persen_penilaian[$j] * $request[$mhs.'|'.$j] / 100.0;
            }

            $nilai = nilai::findOrCreate($request->id, $mhs);
            $nilai->id_master_nilai = $request->id;
            $nilai->id_mahasiswa = $mhs;
            $nilai->nilai = implode(',', $nilais);
            $nilai->nilai_total = $total;
            $nilai->save();
        }

        return redirect()->back();
    }

    private function parse_nilai($nilai)
    {
        if($nilai >= 85.5){
            return 'A';
        }
        if($nilai >= 75.5){
            return 'AB';
        }
        if($nilai >= 65.5){
            return 'B';
        }
        if($nilai >= 60.5){
            return 'BC';
        }
        if($nilai >= 55.5){
            return 'C';
        }
        if($nilai >= 40.5){
            return 'D';
        }
        if($nilai >= 0){
            return 'E';
        }
    }

    private function parse_nilai4($nilai_huruf)
    {
        if($nilai_huruf == 'A'){
            return 4.0;
        }
        if($nilai_huruf == 'AB'){
            return 3.5;
        }
        if($nilai_huruf == 'B'){
            return 3.0;
        }
        if($nilai_huruf == 'BC'){
            return 2.5;
        }
        if($nilai_huruf == 'C'){
            return 2.0;
        }
        if($nilai_huruf == 'D'){
            return 1.0;
        }
        if($nilai_huruf == 'E'){
            return 0.0;
        }
    }
}
