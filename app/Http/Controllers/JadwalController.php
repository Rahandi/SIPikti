<?php

namespace App\Http\Controllers;

use App\jadwal;
use App\mahasiswa;
use App\mahasiswaJadwal;
use App\masterKelas;
use App\masterDosen;
use App\masterAsisten;
use App\masterMK;
use App\jadwalS;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jadwal = jadwal::all();
        $data = array();
        foreach($jadwal as $jadwals)
        {
            $temp = new \stdClass();
            $temp->id = $jadwals->id;
            $temp->tahun = $jadwals->tahun;
            $temp->termin = $jadwals->termin;
            $kelas = masterKelas::find($jadwals->id_kelas);
            $temp->kelas = $kelas->nama;
            $temp->jam_sk = $kelas->jam_SK;
            $temp->jam_j = $kelas->jam_J;
            $temp_mk = array();
            $ids_mk = explode(',', $jadwals->ids_mk);
            foreach($ids_mk as $id_mk)
            {
                array_push($temp_mk, masterMK::find($id_mk)->nama);
            }
            $temp->mk = implode(', ', $temp_mk);
            $temp->hitung = $this->hitung_mahasiswa_jadwal($jadwals->id);
            array_push($data, $temp);
        }
        return view('akademik.jadwal.index', compact('data'));
    }

    public function create()
    {
        $data = new \stdClass();

        $data->masterKelas = masterKelas::all();
        $data->masterDosen = masterDosen::all();
        $data->masterAsisten = masterAsisten::all();
        $data->masterMK = masterMK::all();

        return view('akademik.jadwal.create', compact('data'));
    }

    public function store(Request $request)
    {
        $jadwal = new jadwal();
        $jadwal->termin = $request->termin;
        $jadwal->tahun = $request->tahun;
        $jadwal->id_kelas = masterKelas::where('nama','=',$request->kelas)->first()->id;

        $matkul = [];
        $dosen = [];
        $asisten = [];
        for($i=0;$i<count($request->matkul);$i++)
        {
            if(in_array($request->matkul[$i], $matkul))
            {
                if($request->kelas != 's' && $request->kelas != 'S')
                {
                    return redirect()->back()->with("status", "Tidak boleh ada mata kuliah yang sama");
                }
            }
            else
            {
                ($request->matkul[$i]) ? array_push($matkul, $request->matkul[$i]) : array_push($matkul, '0');
                ($request->dosen[$i]) ? array_push($dosen, $request->dosen[$i]) : array_push($dosen, '0');
                ($request->asisten[$i]) ? array_push($asisten, $request->asisten[$i]) : array_push($asisten, '0');
            }
        }
        $jadwal->ids_mk = implode(',', $matkul);
        $jadwal->ids_dosen = implode(',', $dosen);
        $jadwal->ids_asisten = implode(',', $asisten);

        if($request->kelas == 's' || $request->kelas == 'S')
        {
            $jadwals = new jadwalS();
            $matkul = [];
            $bagian = [];
            $dosen = [];
            $asisten = [];
            $tanggal = [];
            for($i=0;$i<count($request->matkul);$i++)
            {
                ($request->matkul[$i]) ? array_push($matkul, $request->matkul[$i]) : array_push($matkul, '0');
                ($request->bagian_mk[$i]) ? array_push($bagian, $request->bagian_mk[$i]) : array_push($bagian, '0');
                ($request->dosen[$i]) ? array_push($dosen, $request->dosen[$i]) : array_push($dosen, '0');
                ($request->asisten[$i]) ? array_push($asisten, $request->asisten[$i]) : array_push($asisten, '0');
                ($request->tgl_mk[$i]) ? array_push($tanggal, $request->tgl_mk[$i]) : array_push($tanggal, '0');
            }
            $jadwals->bagian = implode(',', $bagian);
            $jadwals->ids_mk = implode(',', $matkul);
            $jadwals->ids_dosen = implode(',', $dosen);
            $jadwals->ids_asisten = implode(',', $asisten);
            $jadwals->tanggals = implode(',', $tanggal);

            $jadwals->save();

            $jadwal->jadwalS_id = $jadwals->id;
        }

        $jadwal->save();

        return redirect()->route('jadwal');
    }

    public function edit(Request $request)
    {
        $data = new \stdClass();
        $jadwal = jadwal::find($request->id);

        if($jadwal->jadwalS_id)
        {
            $jadwals = jadwalS::find($jadwal->jadwalS_id);
            $ids_mk = explode(',', $jadwals->ids_mk);
            $ids_dosen = explode(',',$jadwals->ids_dosen);
            $ids_asisten = explode(',',$jadwals->ids_asisten);
            $bagians = explode(',', $jadwals->bagian);
            $tanggals = explode(',', $jadwals->tanggals);
        }
        else
        {
            $ids_mk = explode(',',$jadwal->ids_mk);
            $ids_dosen = explode(',',$jadwal->ids_dosen);
            $ids_asisten = explode(',',$jadwal->ids_asisten);
        }
        
        $mk = array();
        $dosen = array();
        $asisten = array();
        $bagian = array();
        $tanggal = array();

        for($i=0;$i<count($ids_mk);$i++)
        {
            ($ids_mk[$i])?array_push($mk, $ids_mk[$i]):array_push($mk, null);
            ($ids_dosen[$i])?array_push($dosen, $ids_dosen[$i]):array_push($dosen, null);
            ($ids_asisten[$i])?array_push($asisten, $ids_asisten[$i]):array_push($asisten, null);

            if($jadwal->jadwalS_id)
            {
                array_push($tanggal, $tanggals[$i]);
                array_push($bagian, $bagians[$i]);
            }
        }

        $data->id = $request->id;
        $data->termin = $jadwal->termin;
        $data->tahun = $jadwal->tahun;
        $data->kelas = masterKelas::find($jadwal->id_kelas)->nama;
        $data->matkul = $mk;
        $data->dosen = $dosen;
        $data->asisten = $asisten;
        $data->bagian = $bagian;
        $data->tanggal = $tanggal;
        $data->jumlah_pertemuan = count($ids_mk);
        $data->masterKelas = masterKelas::all();
        $data->masterDosen = masterDosen::all();
        $data->masterAsisten = masterAsisten::all();
        $data->masterMK = masterMK::all();

        return view('akademik.jadwal.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $jadwal = jadwal::find($request->id);
        $jadwal->termin = $request->termin;
        $jadwal->tahun = $request->tahun;
        $jadwal->id_kelas = masterKelas::where('nama','=',$request->kelas)->first()->id;
        
        $mk = array();
        $dosen = array();
        $asisten = array();
        for($i=0;$i<count($request->matkul);$i++)
        {
            if(in_array($request->matkul[$i], $mk))
            {
                if($request->kelas != 's' && $request->kelas != 'S')
                {
                    return redirect()->back()->with("status", "Tidak boleh ada mata kuliah yang sama");
                }
            }
            else
            {
                ($request->matkul[$i]) ? array_push($mk, $request->matkul[$i]) : array_push($mk, '0');
                ($request->dosen[$i]) ? array_push($dosen, $request->dosen[$i]) : array_push($dosen, '0');
                ($request->asisten[$i]) ? array_push($asisten, $request->asisten[$i]) : array_push($asisten, '0');
            }
        }
        $jadwal->ids_mk = implode(',', $mk);
        $jadwal->ids_dosen = implode(',', $dosen);
        $jadwal->ids_asisten = implode(',', $asisten);

        if($request->kelas == 's' || $request->kelas == 'S')
        {
            $jadwals = jadwalS::find($jadwal->jadwalS_id);
            $matkul = [];
            $bagian = [];
            $dosen = [];
            $asisten = [];
            $tanggal = [];
            for($i=0;$i<count($request->matkul);$i++)
            {
                ($request->matkul[$i]) ? array_push($matkul, $request->matkul[$i]) : array_push($matkul, '0');
                ($request->bagian_mk[$i]) ? array_push($bagian, $request->bagian_mk[$i]) : array_push($bagian, '0');
                ($request->dosen[$i]) ? array_push($dosen, $request->dosen[$i]) : array_push($dosen, '0');
                ($request->asisten[$i]) ? array_push($asisten, $request->asisten[$i]) : array_push($asisten, '0');
                ($request->tgl_mk[$i]) ? array_push($tanggal, $request->tgl_mk[$i]) : array_push($tanggal, '0');
            }
            $jadwals->bagian = implode(',', $bagian);
            $jadwals->ids_mk = implode(',', $matkul);
            $jadwals->ids_dosen = implode(',', $dosen);
            $jadwals->ids_asisten = implode(',', $asisten);
            $jadwals->tanggals = implode(',', $tanggal);

            $jadwals->save();
        }
        $jadwal->save();
        return redirect()->route('jadwal');
    }

    public function delete(Request $request)
    {
        $jadwal = jadwal::find($request->id);
        $mahasiswa_jadwal = mahasiswaJadwal::where('jadwal_id', $request->id)->get();

        foreach($mahasiswa_jadwal as $item)
        {
            $item->delete();
        }

        if($jadwal->jadwalS_id)
        {
            $jadwals = jadwalS::find($jadwal->jadwalS_id);
            $jadwals->delete();
        }

        $jadwal->delete();
        return redirect()->route('jadwal');
    }

    public function detail($id)
    {
        $jadwal = jadwal::find($id);

        $data = new \stdClass();
        $data->id = $id;
        $data->termin = $jadwal->termin;
        $data->kelas = masterKelas::find($jadwal->id_kelas);
        
        $data->hitung = $this->hitung_mahasiswa_jadwal($id);
        
        $mk = array();
        $dosen = array();
        $asisten = array();
        $tanggal = array();

        if($data->kelas->nama == 's' || $data->kelas->nama == 'S')
        {
            $jadwals = jadwalS::find($jadwal->jadwalS_id);
            $ids_mk = explode(',',$jadwals->ids_mk);
            $ids_dosen = explode(',',$jadwals->ids_dosen);
            $ids_asisten = explode(',',$jadwals->ids_asisten);
            $bagian = explode(',', $jadwals->bagian);
            $tanggals = explode(',', $jadwals->tanggals);
        }
        else
        {
            $ids_mk = explode(',',$jadwal->ids_mk);
            $ids_dosen = explode(',',$jadwal->ids_dosen);
            $ids_asisten = explode(',',$jadwal->ids_asisten);
        }

        for($i=0;$i<count($ids_mk);$i++)
        {
            if($ids_mk[$i])
            {
                $temp = new \stdClass();
                $master_mk = masterMK::find($ids_mk[$i]);
                $temp->nama = (isset($bagian)) ? $master_mk->nama.' '.$bagian[$i] : $master_mk->nama;
                $temp->bagian = (isset($bagian)) ? $bagian[$i] : null;
                $temp->id = $master_mk->id;
                array_push($mk, $temp);
            }
            else
            {
                $temp = new \stdClass();
                $temp->nama = null;
                $temp->id = null;
                array_push($mk, $temp);
            }

            ($ids_dosen[$i])?array_push($dosen, masterDosen::find($ids_dosen[$i])->nama):array_push($dosen, null);
            ($ids_asisten[$i])?array_push($asisten, masterAsisten::find($ids_asisten[$i])->nama):array_push($asisten, null);

            if(isset($tanggals))
            {
                array_push($tanggal, $tanggals[$i]);
            }
        }
        
        $mahasiswa_jadwal = \DB::table('mahasiswa_jadwal')
                                ->select('mahasiswa_id')
                                ->groupBy('mahasiswa_id')
                                ->where('jadwal_id', '=', $id)
                                ->get();

        $mahasiswa = array();
        foreach($mahasiswa_jadwal as $row)
        {
            array_push($mahasiswa, mahasiswa::find($row->mahasiswa_id));
        }

        $data->matkul = $mk;
        $data->dosen = $dosen;
        $data->asisten = $asisten;
        $data->mahasiswa = $mahasiswa;
        $data->tanggal = $tanggal;

        return view('akademik.jadwal.detail', compact('data'));
    }

    public function PageSelectJadwal($id)
    {
        $data = new \stdClass();
        $data->id_mahasiswa = mahasiswa::find($id);
        $data->jadwal = array();
        $jadwals = jadwal::all();
        foreach ($jadwals as $jadwal)
        {
            $temp = new \stdClass();
            $ids_mk = explode(',',$jadwal->ids_mk);
            $ids_dosen = explode(',',$jadwal->ids_dosen);
            $ids_asisten = explode(',',$jadwal->ids_asisten);
            
            $mk = array();
            foreach($ids_mk as $indvmk)
            {
                ($indvmk)?array_push($mk, masterMK::find($indvmk)->nama):array_push($mk, null);
            }

            $dosen = array();
            foreach($ids_dosen as $indvdosen)
            {
                ($indvdosen)?array_push($dosen, masterDosen::find($indvdosen)->nama):array_push($dosen, null);
            }

            $asisten = array();
            foreach($ids_asisten as $indvasisten)
            {
                ($indvasisten)?array_push($asisten, masterAsisten::find($indvasisten)->nama):array_push($asisten, null);
            }

            $temp->id = $jadwal->id;
            $temp->termin = $jadwal->termin;
            $temp->kelas = masterKelas::find($jadwal->id_kelas);
            $temp->matkul = $mk;
            $temp->dosen = $dosen;
            $temp->asisten = $asisten;
            $temp->hitung = $this->hitung_mahasiswa_jadwal($jadwal->id);

            array_push($data->jadwal, $temp);
        }
        return view('akademik.jadwal.select', compact('data'));
    }

    public function SelectJadwal(Request $request)
    {
        $data = mahasiswaJadwal::where('mahasiswa_id', $request->id_mahasiswa)->get();
        foreach($data as $item)
        {
            $item->delete();
        }
        $data = new mahasiswaJadwal();
        $data->mahasiswa_id = $request->id_mahasiswa;
        $data->jadwal_id = $request->jadwal_id;
        $data->save();
        return redirect()->route('pembayaran.detail', ['id'=>$request->id_mahasiswa]);
    }

    public function cancel(Request $request)
    {
        $match = [
            'mahasiswa_id' => $request->mhs,
            'jadwal_id' => $request->jdw
        ];
        $data = mahasiswaJadwal::where($match)->get();
        foreach($data as $item)
        {
            $item->delete();
        }
        return redirect()->back();
    }

    public function pilihmhs($id)
    {
        $data = new \stdClass();
        $jadwal = jadwal::find($id);
        $termin = $jadwal->termin;
        $tahun = $jadwal->tahun;
        $kelas = masterKelas::find($jadwal->id_kelas);
        $mahasiswa = $this->get_mahasiswa_no_jadwal($termin, $tahun);
        $data->jadwal = $jadwal;
        $data->mahasiswa = $mahasiswa;
        $data->kelas = $kelas;
        return view('akademik.jadwal.tambah_mhs', compact('data'));
    }

    public function tambah(Request $request)
    {
        if ($request->cekboks)
        {
            $picked = explode(',', $request->cekboks);
            foreach($picked as $id)
            {
                $data = new mahasiswaJadwal();
                $data->mahasiswa_id = $id;
                $data->jadwal_id = $request->jadwal;
                $data->save();
            }
        }
        return redirect()->route('jadwal.detail', ['id' => $request->jadwal]);
    }

    public function DownloadJadwal($id_jadwal, $id_mk)
    {
        $data = new \stdClass();

        $jadwal = jadwal::find($id_jadwal);
        $mk = explode(',', $jadwal->ids_mk);
        if($id_mk)
        {
            $index_mk = array_search($id_mk, $mk);

            $data->termin = $jadwal->termin;
            $data->mata_kuliah = masterMK::find($id_mk)->nama;
            $data->kelas = masterKelas::find($jadwal->id_kelas)->nama;
            $data->tahun = $jadwal->tahun;

            if($data->kelas == 'A'){
                $data->jam = '08:00 - 10:00';
                if($index_mk == 4)
                {
                    $data->jam = '07:00 - 09:00';
                }
            }
            elseif($data->kelas == 'B'){
                $data->jam = '10:00 - 12:00';
                if($index_mk == 4)
                {
                    $data->jam = '09:00 - 11:00';
                }
            }
            elseif($data->kelas == 'C'){
                $data->jam = '12:00 - 14:00';
                if($index_mk == 4)
                {
                    $data->jam = '12:30 - 14:30';
                }
            }
            elseif($data->kelas == 'D'){
                $data->jam = '14:00 - 16:00';
                if($index_mk == 4)
                {
                    $data->jam = '14:30 - 16:30';
                }
            }
            elseif($data->kelas == 'E'){
                $data->jam = '16:00 - 18:00';
                if($index_mk == 4)
                {
                    $data->jam = '16:30 - 18:30';
                }
            }
            elseif($data->kelas == 'F'){
                $data->jam = '18:30 - 20:30';
                if($index_mk == 4)
                {
                    $data->jam = '18:30 - 20:30';
                }
            }

            if($index_mk == 0){
                $data->hari = 'Senin';
            }
            elseif($index_mk == 1){
                $data->hari = 'Selasa';
            }
            elseif($index_mk == 2){
                $data->hari = 'Rabu';
            }
            elseif($index_mk == 3){
                $data->hari = 'Kamis';
            }
            elseif($index_mk == 4){
                $data->hari = 'Jumat';
            }

            $dosen = masterDosen::find(explode(',', $jadwal->ids_dosen)[$index_mk]);
            $data->dosen = ($dosen)?$dosen->nama:null;

            $asisten = masterAsisten::find(explode(',', $jadwal->ids_asisten)[$index_mk]);
            $data->asisten = new \stdClass();
            $data->asisten->nrp = ($asisten)?$asisten->nrp:null;
            $data->asisten->nama = ($asisten)?$asisten->nama:null;

            $data->mahasiswa = array();
            $mahasiswa_jadwal = mahasiswaJadwal::where('jadwal_id', $id_jadwal)->get()->toArray();
            $mahasiswa_jadwal = array_map(function($a){return $a['mahasiswa_id'];}, $mahasiswa_jadwal);
            $mahasiswa_jadwal = mahasiswa::whereIn('id', $mahasiswa_jadwal)->orderBy('nrp', 'asc')->get();
            $urut = 0;
            foreach($mahasiswa_jadwal as $item)
            {
                $urut += 1;
                $temp = new \stdClass();
                $temp->urut = $urut;
                $temp->nama = $item->nama;
                $temp->nrp = $item->nrp;
                array_push($data->mahasiswa, $temp);
            }

            return view('akademik.jadwal.download', compact('data'));
        }
        else
        {
            $absen_dosen = [];
            $jadwal_S = jadwalS::find($jadwal->jadwalS_id);
            $tanggals = explode(',', $jadwal_S->tanggals);
            $bagians = explode(',', $jadwal_S->bagian);
            $ids_mk = explode(',', $jadwal_S->ids_mk);
            $ids_dosen = explode(',', $jadwal_S->ids_dosen);
            $ids_asisten = explode(',', $jadwal_S->ids_asisten);

            for($i=0;$i<count($ids_mk);$i++)
            {
                $temp = new \stdClass();
                $temp->matkul = masterMK::find($ids_mk[$i])->nama . ' ' . $bagians[$i];
                $temp->dosen = ($ids_dosen[$i]) ? masterDosen::find($ids_dosen[$i])->nama : null;
                $temp->asisten = ($ids_asisten[$i]) ? masterAsisten::find($ids_asisten[$i])->nama : null;
                $temp->tanggal = $this->parse_date_to_indo($tanggals[$i]);

                array_push($absen_dosen, $temp);
            }

            $absen_mahasiswa = [];
            $mk_count = array_count_values($ids_mk);
            foreach ($mk_count as $key => $value) {
                $temp = new \stdClass();
                $temp->nama = masterMK::find($key)->nama;
                $temp->bagian = $value;
                array_push($absen_mahasiswa, $temp);
            }

            $mahasiswas = [];
            $mahasiswa_jadwal = mahasiswaJadwal::where('jadwal_id', $id_jadwal)->get()->toArray();
            $mahasiswa_jadwal = array_map(function($a){return $a['mahasiswa_id'];}, $mahasiswa_jadwal);
            $mahasiswa_jadwal = mahasiswa::whereIn('id', $mahasiswa_jadwal)->orderBy('nrp', 'asc')->get();
            for($i=0;$i<count($mahasiswa_jadwal);$i++)
            {
                $temp = new \stdClass();
                $temp->urut = $i + 1;
                $temp->nama = $mahasiswa_jadwal[$i]->nama;
                $temp->nrp = $mahasiswa_jadwal[$i]->nrp;
                array_push($mahasiswas, $temp);
            }

            $data->semester = $jadwal->termin;
            $data->tahun = $jadwal->tahun;
            $data->kelas = masterKelas::find($jadwal->id_kelas)->nama;
            $data->absen_dosen = $absen_dosen;
            $data->absen_mahasiswa = $absen_mahasiswa;
            $data->mahasiswa = $mahasiswas;

            return view('akademik.jadwal.download_eksekutif', compact('data'));
        }
    }

    public function beritaAcara(Request $request)
    {
        $id_jadwal = $request->id_jadwal;
        $id_mk = $request->id_mk;
        $tanggal = $request->tanggal;
        $waktu_start = $request->waktu_start;
        $waktu_end = $request->waktu_end;
        $jenis = $request->jenis;

        $data = new \stdClass();

        $jadwal = jadwal::find($id_jadwal);
        $kelas = masterKelas::find($jadwal->id_kelas);

        $data->semester = $jadwal->termin;
        $data->tahun = $jadwal->tahun . ' - ' . ($jadwal->tahun + 1);
        $data->kelas = $kelas->nama;
        $data->waktu = $waktu_start . ' - ' . $waktu_end;
        $data->jenis = ($jenis == 'ets')?'EVALUASI TENGAH SEMESTER':'EVALUASI AKHIR SEMESTER';
        $data->tamggal = $this->parse_date_to_indo($tanggal);

        $mks = explode(',', $jadwal->ids_mk);
        if($kelas->nama != 'S')
        {
            $index_mk = array_search($id_mk, $mks);

            $mk = masterMK::find($id_mk);
            $data->mata_kuliah = $mk->nama;

            $dosen = masterDosen::find(explode(',', $jadwal->ids_dosen)[$index_mk]);
            $data->dosen = ($dosen)?$dosen->nama:null;

            if($index_mk == 0){
                $data->hari = 'Senin';
            }
            elseif($index_mk == 1){
                $data->hari = 'Selasa';
            }
            elseif($index_mk == 2){
                $data->hari = 'Rabu';
            }
            elseif($index_mk == 3){
                $data->hari = 'Kamis';
            }
            elseif($index_mk == 4){
                $data->hari = 'Jumat';
            }
        }

        return view('akademik.jadwal.beritaacara', compact('data'));
    }

    private function get_mahasiswa_no_jadwal($termin, $tahun)
    {
        $mahasiswa_punya_jadwal = mahasiswaJadwal::all();
        $mahasiswa_ids = array();
        foreach($mahasiswa_punya_jadwal as $mhs)
        {            $id_jadwal = $mhs->jadwal_id;
            $jadwal = jadwal::find($id_jadwal);
            if($termin == $jadwal->termin && $tahun == $jadwal->tahun)
            {
                array_push($mahasiswa_ids, $mhs->mahasiswa_id);
            }
        }
        $mahasiswa = \DB::table('mahasiswa')
                        ->select('*')
                        ->whereNotIn('id', $mahasiswa_ids)
                        ->where('nrp', '!=', null)
                        ->get();
        return $mahasiswa;
    }

    private function hitung_mahasiswa_jadwal($jadwal_id)
    {
        $data = \DB::table('mahasiswa_jadwal')
                    ->select('mahasiswa_id')
                    ->where('jadwal_id', '=', $jadwal_id)
                    ->groupBy('mahasiswa_id')
                    ->get();
        return count($data);
    }

    private function parse_date_to_indo($date)
    {
        $parted = explode('-', $date);
        if ($parted[1] == '01')
        {
            $parted[1] = 'Januari';
        }
        elseif ($parted[1] == '02')
        {
            $parted[1] = 'Februari';
        }
        elseif ($parted[1] == '03')
        {
            $parted[1] = 'Maret';
        }
        elseif ($parted[1] == '04')
        {
            $parted[1] = 'April';
        }
        elseif ($parted[1] == '05')
        {
            $parted[1] = 'Mei';
        }
        elseif ($parted[1] == '06')
        {
            $parted[1] = 'Juni';
        }
        elseif ($parted[1] == '07')
        {
            $parted[1] = 'Juli';
        }
        elseif ($parted[1] == '08')
        {
            $parted[1] = 'Agustus';
        }
        elseif ($parted[1] == '09')
        {
            $parted[1] = 'September';
        }
        elseif ($parted[1] == '10')
        {
            $parted[1] = 'Oktober';
        }
        elseif ($parted[1] == '11')
        {
            $parted[1] = 'November';
        }
        elseif ($parted[1] == '12')
        {
            $parted[1] = 'Desember';
        }
        $diwalik = [$parted[2], $parted[1], $parted[0]];
        return implode(' ', $diwalik);
    }
}