<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mahasiswa;
use App\nilai;
use App\masterNilai;
use App\masterMK;
use App\config;
use App\mahasiswaJadwal;
use App\jadwal;
use App\masterKelas;
use App\akhir_kompre;
use App\akhir_kp;
use App\akhir_pa;
use App\akhir_pakp;

class TranskripController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $nomor_transkrip = config::where('name', 'nomor_transkrip')->first()->data;
        $data = mahasiswa::all();
        foreach($data as $mahasiswa)
        {
            $nilai = nilai::where('id_mahasiswa', $mahasiswa->id)->get();
            $mahasiswa->nilai = (count($nilai) > 0) ? $nilai : NULL;

            $mahasiswajadwal = mahasiswaJadwal::where('mahasiswa_id', $mahasiswa->id)->first();
            if($mahasiswajadwal)
            {
                $jadwal = jadwal::find($mahasiswajadwal->jadwal_id);
                $kelas = masterKelas::find($jadwal->id_kelas);
                $mahasiswa->kelas = $kelas->nama;
            }
            else
            {
                $mahasiswa->kelas = NULL;
            }
            
            $pakp = $this->mahasiswa_pakp($mahasiswa->id);
            $mahasiswa->jenis = $pakp->jenis;
        }

        $jadwals = jadwal::all();
        foreach($jadwals as $jadwal)
        {
            $jadwal->kelas = masterKelas::find($jadwal->id_kelas)->nama;
        }

        return view('akademik.transkrip.index', ['data' => $data, 'nomor_transkrip' => $nomor_transkrip, 'jadwal' => $jadwals]);
    }

    public function transkrip(Request $request, $transkrip)
    {
        $pejabat1 = config::where('name', 'pejabat 1')->first();
        $pejabat2 = config::where('name', 'pejabat 2')->first();

        $pejabat = new \stdClass();
        $pejabat->satu = new \stdClass();
        $pejabat->dua = new \stdClass();

        $temp1 = explode('|', $pejabat1->data);
        $temp2 = explode('|', $pejabat2->data);

        $pejabat->satu->jabatan = $temp1[0];
        $pejabat->satu->nama = $temp1[1];
        $pejabat->satu->nip = $temp1[2];

        $pejabat->dua->jabatan = $temp2[0];
        $pejabat->dua->nama = $temp2[1];
        $pejabat->dua->nip = $temp2[2];

        if ($transkrip == 'sementara')
        {
            $data = $this->sementara($request->id);
            $data->pejabat = $pejabat;
            return view('akademik.transkrip.sementara', compact('data'));
        }
        elseif ($transkrip == 'kp')
        {
            $data = $this->kp($request->id);
            $data->pejabat = $pejabat;
            return view('akademik.transkrip.kp', compact('data'));
        }
        elseif ($transkrip == 'ta')
        {
            $data = $this->ta($request->id);
            $data->pejabat = $pejabat;
            return view('akademik.transkrip.ta', compact('data'));
        }
        elseif ($transkrip == 'takp')
        {
            $data = $this->takp($request->id);
            $data->pejabat = $pejabat;
            return view('akademik.transkrip.takp', compact('data'));
        }

        return redirect()->route('transkrip');
    }

    public function transkrip_kelas(Request $request, $transkrip)
    {
        $pejabat1 = config::where('name', 'pejabat 1')->first();
        $pejabat2 = config::where('name', 'pejabat 2')->first();

        $pejabat = new \stdClass();
        $pejabat->satu = new \stdClass();
        $pejabat->dua = new \stdClass();

        $temp1 = explode('|', $pejabat1->data);
        $temp2 = explode('|', $pejabat2->data);

        $pejabat->satu->jabatan = $temp1[0];
        $pejabat->satu->nama = $temp1[1];
        $pejabat->satu->nip = $temp1[2];

        $pejabat->dua->jabatan = $temp2[0];
        $pejabat->dua->nama = $temp2[1];
        $pejabat->dua->nip = $temp2[2];

        $data = [];

        $mahasiswa_jadwal = mahasiswaJadwal::where('jadwal_id', $request->jadwal_id)->get();
        // dd($request->jadwal_id);
        foreach($mahasiswa_jadwal as $mahasiswa)
        {
            if ($transkrip == 'sementara')
            {
                $datas = $this->sementara($mahasiswa->mahasiswa_id);
                $datas->pejabat = $pejabat;
                array_push($data, $datas);
            }
            elseif ($transkrip == 'kp')
            {
                $datas = $this->kp($mahasiswa->mahasiswa_id);
                $datas->pejabat = $pejabat;
                array_push($data, $datas);
            }
            elseif ($transkrip == 'ta')
            {
                $datas = $this->ta($mahasiswa->mahasiswa_id);
                $datas->pejabat = $pejabat;
                array_push($data, $datas);
            }
            elseif ($transkrip == 'takp')
            {
                $datas = $this->takp($mahasiswa->mahasiswa_id);
                $datas->pejabat = $pejabat;
                array_push($data, $datas);
            }
        }

        if ($transkrip == 'sementara')
        {
            return view('akademik.transkrip.sementara_kelas', ['datas' => $data]);
        }
        elseif ($transkrip == 'kp')
        {
            return view('akademik.transkrip.kp_kelas', ['datas' => $data]);
        }
        elseif ($transkrip == 'ta')
        {
            return view('akademik.transkrip.ta_kelas', ['datas' => $data]);
        }
        elseif ($transkrip == 'takp')
        {
            return view('akademik.transkrip.takp_kelas', ['datas' => $data]);
        }

        return redirect()->route('transkrip');
    }

    private function sementara($id)
    {
        $nomor_transkrip = config::where('name', 'nomor_transkrip')->first();
        $mahasiswa = mahasiswa::find($id);
        $nilais = nilai::where('id_mahasiswa', $id)->get();

        $data = new \stdClass();
        $data->nomor_transkrip = $nomor_transkrip->data . date('Y');
        $data->nama = $mahasiswa->nama;
        $data->nrp = $mahasiswa->nrp;
        $data->ttl = $mahasiswa->tempat_lahir . ', ' . $this->parse_date($mahasiswa->tanggal_lahir);
        
        $nrp_split = str_split($mahasiswa->nrp);
        $data->tahun_masuk = '20' . $nrp_split[2] . $nrp_split[3];
        $data->tahun_lulus = '20' . ((int)($nrp_split[2] . $nrp_split[3]) + 1);
        
        $data->nilai = array();
        $total = 0;
        $hitung = 0;
        $total_sks = 0;
        foreach ($nilais as $nilai) {
            $id_master_nilai = $nilai->id_master_nilai;
            $master_nilai = masterNilai::find($id_master_nilai);
            $master_mk = masterMK::find($master_nilai->id_mk);
            $temp = new \stdClass();
            $temp->nama = $master_mk->nama;
            $temp->semester = $master_nilai->termin;
            $temp->sks = $master_mk->sks;
            $temp->kode = $master_mk->kode_mk;
            $temp->nilai_huruf = $this->parse_nilai($nilai->nilai_total);
            $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
            array_push($data->nilai, $temp);

            $total += $temp->nilai;
            $hitung += 1;
            $total_sks += $temp->sks;
        }

        $pakp = $this->mahasiswa_pakp($id);
        if($pakp->tahun)
        {
            if($pakp->nilai_pa)
            {
                $data->judul = $pakp->judul;
                $data->pembimbing = $pakp->pembimbing;

                $masterMK = masterMK::where('kode_mk', 'IF190215')->first();

                $temp = new \stdClass();
                $temp->nama = $masterMK->nama;
                $temp->semester = $masterMK->semester;
                $temp->sks = $masterMK->sks;
                $temp->kode = $masterMK->kode_mk;
                $temp->nilai_huruf = $pakp->nilai_pa;
                $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
                array_push($data->nilai, $temp);
            }
            if($pakp->nilai_kp)
            {
                $masterMK = masterMK::where('kode_mk', 'IF190214')->first();

                $temp = new \stdClass();
                $temp->nama = $masterMK->nama;
                $temp->semester = $masterMK->semester;
                $temp->sks = $masterMK->sks;
                $temp->kode = $masterMK->kode_mk;
                $temp->nilai_huruf = $pakp->nilai_kp;
                $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
                array_push($data->nilai, $temp);
            }
        }

        $data->ipk = number_format((float)($total / $hitung), 2, '.', '');
        $data->predikat = $this->parse_predikat($data->ipk);
        $data->total_sks = $total_sks;
        
        return $data;
    }

    private function kp($id)
    {
        $nomor_transkrip = config::where('name', 'nomor_transkrip')->first();
        $mahasiswa = mahasiswa::find($id);
        $nilais = nilai::where('id_mahasiswa', $id)->get();

        $data = new \stdClass();
        $data->nomor_transkrip = $nomor_transkrip->data . date('Y');
        $data->nama = $mahasiswa->nama;
        $data->nrp = $mahasiswa->nrp;
        $data->ttl = $mahasiswa->tempat_lahir . ', ' . $this->parse_date($mahasiswa->tanggal_lahir);
        
        $nrp_split = str_split($mahasiswa->nrp);
        $data->tahun_masuk = '20' . $nrp_split[2] . $nrp_split[3];
        $data->tahun_lulus = '20' . ((int)($nrp_split[2] . $nrp_split[3]) + 1);
        
        $data->nilai = array();
        $total = 0;
        $hitung = 0;
        $total_sks = 0;
        foreach ($nilais as $nilai) {
            $id_master_nilai = $nilai->id_master_nilai;
            $master_nilai = masterNilai::find($id_master_nilai);
            $master_mk = masterMK::find($master_nilai->id_mk);
            $temp = new \stdClass();
            $temp->nama = $master_mk->nama;
            $temp->semester = $master_nilai->termin;
            $temp->sks = $master_mk->sks;
            $temp->kode = $master_mk->kode_mk;
            $temp->nilai_huruf = $this->parse_nilai($nilai->nilai_total);
            $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
            array_push($data->nilai, $temp);

            $total += $temp->nilai;
            $hitung += 1;
            $total_sks += $temp->sks;
        }

        $pakp = $this->mahasiswa_pakp($id);
        if($pakp->tahun)
        {
            if($pakp->nilai_pa)
            {
                $data->judul = $pakp->judul;
                $data->pembimbing = $pakp->pembimbing;

                $masterMK = masterMK::where('kode_mk', 'IF190215')->first();

                $temp = new \stdClass();
                $temp->nama = $masterMK->nama;
                $temp->semester = $masterMK->semester;
                $temp->sks = $masterMK->sks;
                $temp->kode = $masterMK->kode_mk;
                $temp->nilai_huruf = $pakp->nilai_pa;
                $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
                array_push($data->nilai, $temp);
            }
            if($pakp->nilai_kp)
            {
                $masterMK = masterMK::where('kode_mk', 'IF190214')->first();

                $temp = new \stdClass();
                $temp->nama = $masterMK->nama;
                $temp->semester = $masterMK->semester;
                $temp->sks = $masterMK->sks;
                $temp->kode = $masterMK->kode_mk;
                $temp->nilai_huruf = $pakp->nilai_kp;
                $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
                array_push($data->nilai, $temp);
            }
        }

        $data->ipk = number_format((float)($total / $hitung), 2, '.', '');
        $data->predikat = $this->parse_predikat($data->ipk);
        $data->total_sks = $total_sks;
        
        return $data;
    }

    private function ta($id)
    {
        $nomor_transkrip = config::where('name', 'nomor_transkrip')->first();
        $mahasiswa = mahasiswa::find($id);
        $nilais = nilai::where('id_mahasiswa', $id)->get();

        $data = new \stdClass();
        $data->nomor_transkrip = $nomor_transkrip->data . date('Y');
        $data->nama = $mahasiswa->nama;
        $data->nrp = $mahasiswa->nrp;
        $data->ttl = $mahasiswa->tempat_lahir . ', ' . $this->parse_date($mahasiswa->tanggal_lahir);
        
        $nrp_split = str_split($mahasiswa->nrp);
        $data->tahun_masuk = '20' . $nrp_split[2] . $nrp_split[3];
        $data->tahun_lulus = '20' . ((int)($nrp_split[2] . $nrp_split[3]) + 1);
        
        $data->nilai = array();
        $total = 0;
        $hitung = 0;
        $total_sks = 0;
        foreach ($nilais as $nilai) {
            $id_master_nilai = $nilai->id_master_nilai;
            $master_nilai = masterNilai::find($id_master_nilai);
            $master_mk = masterMK::find($master_nilai->id_mk);
            $temp = new \stdClass();
            $temp->nama = $master_mk->nama;
            $temp->semester = $master_nilai->termin;
            $temp->sks = $master_mk->sks;
            $temp->kode = $master_mk->kode_mk;
            $temp->nilai_huruf = $this->parse_nilai($nilai->nilai_total);
            $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
            array_push($data->nilai, $temp);

            $total += $temp->nilai;
            $hitung += 1;
            $total_sks += $temp->sks;
        }

        $pakp = $this->mahasiswa_pakp($id);
        if($pakp->tahun)
        {
            if($pakp->nilai_pa)
            {
                $data->judul = $pakp->judul;
                $data->pembimbing = $pakp->pembimbing;

                $masterMK = masterMK::where('kode_mk', 'IF190215')->first();

                $temp = new \stdClass();
                $temp->nama = $masterMK->nama;
                $temp->semester = $masterMK->semester;
                $temp->sks = $masterMK->sks;
                $temp->kode = $masterMK->kode_mk;
                $temp->nilai_huruf = $pakp->nilai_pa;
                $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
                array_push($data->nilai, $temp);
            }
            if($pakp->nilai_kp)
            {
                $masterMK = masterMK::where('kode_mk', 'IF190214')->first();

                $temp = new \stdClass();
                $temp->nama = $masterMK->nama;
                $temp->semester = $masterMK->semester;
                $temp->sks = $masterMK->sks;
                $temp->kode = $masterMK->kode_mk;
                $temp->nilai_huruf = $pakp->nilai_kp;
                $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
                array_push($data->nilai, $temp);
            }
        }

        $data->ipk = number_format((float)($total / $hitung), 2, '.', '');
        $data->predikat = $this->parse_predikat($data->ipk);
        $data->total_sks = $total_sks;
        
        return $data;
    }

    private function takp($id)
    {
        $nomor_transkrip = config::where('name', 'nomor_transkrip')->first();
        $mahasiswa = mahasiswa::find($id);
        $nilais = nilai::where('id_mahasiswa', $id)->get();

        $data = new \stdClass();
        $data->nomor_transkrip = $nomor_transkrip->data . date('Y');
        $data->nama = $mahasiswa->nama;
        $data->nrp = $mahasiswa->nrp;
        $data->ttl = $mahasiswa->tempat_lahir . ', ' . $this->parse_date($mahasiswa->tanggal_lahir);
        
        $nrp_split = str_split($mahasiswa->nrp);
        $data->tahun_masuk = '20' . $nrp_split[2] . $nrp_split[3];
        $data->tahun_lulus = '20' . ((int)($nrp_split[2] . $nrp_split[3]) + 1);
        
        $data->nilai = array();
        $total = 0;
        $hitung = 0;
        $total_sks = 0;
        foreach ($nilais as $nilai) {
            $id_master_nilai = $nilai->id_master_nilai;
            $master_nilai = masterNilai::find($id_master_nilai);
            $master_mk = masterMK::find($master_nilai->id_mk);
            $temp = new \stdClass();
            $temp->nama = $master_mk->nama;
            $temp->semester = $master_nilai->termin;
            $temp->sks = $master_mk->sks;
            $temp->kode = $master_mk->kode_mk;
            $temp->nilai_huruf = $this->parse_nilai($nilai->nilai_total);
            $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
            array_push($data->nilai, $temp);

            $total += $temp->nilai;
            $hitung += 1;
            $total_sks += $temp->sks;
        }

        $pakp = $this->mahasiswa_pakp($id);
        if($pakp->tahun)
        {
            if($pakp->nilai_pa)
            {
                $data->judul = $pakp->judul;
                $data->pembimbing = $pakp->pembimbing;

                $masterMK = masterMK::where('kode_mk', 'IF190215')->first();

                $temp = new \stdClass();
                $temp->nama = $masterMK->nama;
                $temp->semester = $masterMK->semester;
                $temp->sks = $masterMK->sks;
                $temp->kode = $masterMK->kode_mk;
                $temp->nilai_huruf = $pakp->nilai_pa;
                $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
                array_push($data->nilai, $temp);
            }
            if($pakp->nilai_kp)
            {
                $masterMK = masterMK::where('kode_mk', 'IF190214')->first();

                $temp = new \stdClass();
                $temp->nama = $masterMK->nama;
                $temp->semester = $masterMK->semester;
                $temp->sks = $masterMK->sks;
                $temp->kode = $masterMK->kode_mk;
                $temp->nilai_huruf = $pakp->nilai_kp;
                $temp->nilai = $this->parse_nilai4($temp->nilai_huruf);
                array_push($data->nilai, $temp);
            }
        }

        $data->ipk = number_format((float)($total / $hitung), 2, '.', '');
        $data->predikat = $this->parse_predikat($data->ipk);
        $data->total_sks = $total_sks;
        
        return $data;
    }

    public function pejabat()
    {
        $pejabat1 = config::where('name', 'pejabat 1')->first();
        $pejabat2 = config::where('name', 'pejabat 2')->first();

        $data = new \stdClass();
        $data->satu = new \stdClass();
        $data->dua = new \stdClass();

        $temp1 = explode('|', $pejabat1->data);
        $temp2 = explode('|', $pejabat2->data);

        $data->satu->jabatan = $temp1[0];
        $data->satu->nama = $temp1[1];
        $data->satu->nip = $temp1[2];

        $data->dua->jabatan = $temp2[0];
        $data->dua->nama = $temp2[1];
        $data->dua->nip = $temp2[2];

        return view('akademik.transkrip.pejabat', compact('data'));
    }

    public function pejabat_update(Request $request)
    {
        $pejabat1 = config::where('name', 'pejabat 1')->first();
        $pejabat2 = config::where('name', 'pejabat 2')->first();
        $nomor_transkrip = config::where('name', 'nomor_transkrip')->first();

        $pejabatsatu = [$request->pejabat1_jabatan, $request->pejabat1_nama, $request->pejabat1_nip];
        $pejabatdua = [$request->pejabat2_jabatan, $request->pejabat2_nama, $request->pejabat2_nip];

        $pejabat1->data = implode('|', $pejabatsatu);
        $pejabat2->data = implode('|', $pejabatdua);

        $pejabat1->save();
        $pejabat2->save();

        return redirect()->route('transkrip');
    }

    public function nomor_transkrip_update(Request $request)
    {
        $config = config::where('name', 'nomor_transkrip')->first();
        $config->data = $request->nomor_transkrip;
        $config->save();
        return redirect()->back();
    }

    private function parse_predikat($ipk)
    {
        if ($ipk > 3.5){
            return 'Dengan Pujian';
        }
        if ($ipk > 2.75){
            return 'Sangat Memuaskan';
        }
        if ($ipk >= 2.0){
            return 'Memuaskan';
        }
        return '-';
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

    private function parse_date($date){
        $dates = explode('-', $date);

        if($dates[1] == '01'){
            $dates[1] = 'Januari';
        }
        else if($dates[1] == '02'){
            $dates[1] = 'Februari';
        }
        else if($dates[1] == '03'){
            $dates[1] = 'Maret';
        }
        else if($dates[1] == '04'){
            $dates[1] = 'April';
        }
        else if($dates[1] == '05'){
            $dates[1] = 'Mei';
        }
        else if($dates[1] == '06'){
            $dates[1] = 'Juni';
        }
        else if($dates[1] == '07'){
            $dates[1] = 'Juli';
        }
        else if($dates[1] == '08'){
            $dates[1] = 'Agustus';
        }
        else if($dates[1] == '09'){
            $dates[1] = 'September';
        }
        else if($dates[1] == '10'){
            $dates[1] = 'Oktober';
        }
        else if($dates[1] == '11'){
            $dates[1] = 'November';
        }
        else if($dates[1] == '12'){
            $dates[1] = 'Desember';
        }

        $parsed = $dates[2] . ' ' . $dates[1] . ' ' . $dates[0];
        
        return $parsed;
    }

    private function mahasiswa_pakp($mahasiswa_id)
    {
        $pa = akhir_pa::where('mahasiswa_id', $mahasiswa_id)->first();
        $kp = akhir_kp::where('mahasiswa_id', $mahasiswa_id)->first();
        $pakp = akhir_pakp::where('mahasiswa_id', $mahasiswa_id)->first();
        $kompre = akhir_kompre::where('mahasiswa_id', $mahasiswa_id)->first();

        $akhir = new \stdClass();
        $akhir->judul = null;
        $akhir->pembimbing = null;
        $akhir->nilai_pa = null;
        $akhir->nilai_kp = null;
        $akhir->tahun = null;
        $akhir->jenis = null;

        if($pa)
        {
            $mahasiswa = $pa;

            $akhir->judul = $mahasiswa->judul;
            $akhir->pembimbing = $mahasiswa->pembimbing;
            $akhir->nilai_pa = $mahasiswa->nilai;
            $akhir->nilai_kp = null;
            $akhir->tahun = $mahasiswa->tahun;
            $akhir->jenis = 'pa';
        }
        elseif($kp)
        {
            $mahasiswa = $kp;

            $akhir->judul = null;
            $akhir->pembimbing = null;
            $akhir->nilai_pa = null;
            $akhir->nilai_kp = $mahasiswa->nilai;
            $akhir->tahun = $mahasiswa->tahun;
            $akhir->jenis = 'kp';
        }
        elseif($pakp)
        {
            $mahasiswa = $pakp;

            $akhir->judul = $mahasiswa->judul;
            $akhir->pembimbing = $mahasiswa->pembimbing;
            $akhir->nilai_pa = $mahasiswa->nilai_pa;
            $akhir->nilai_kp = $mahasiswa->nilai_kp;
            $akhir->tahun = $mahasiswa->tahun;
            $akhir->jenis = 'pakp';
        }
        elseif($kompre)
        {
            $mahasiswa = $kompre;

            $akhir->judul = null;
            $akhir->pembimbing = null;
            $akhir->nilai_pa = null;
            $akhir->nilai_kp = $mahasiswa->nilai;
            $akhir->tahun = $mahasiswa->tahun;
            $akhir->jenis = 'kompre';
        }

        return $akhir;
    }
}