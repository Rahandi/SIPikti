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
        foreach($data as $mahasiswa)
        {
            $nilai = nilai::where('id_mahasiswa', $mahasiswa->id)->get();
            $mahasiswa->nilai = (count($nilai) > 0) ? $nilai : NULL;
        }
        return view('akademik.transkrip.index', compact('data'));
    }

    public function sementara(Request $request)
    {
        $mahasiswa = mahasiswa::find($request->id);
        $nilais = nilai::where('id_mahasiswa', $request->id)->get();

        $data = new \stdClass();
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
            $temp->nilai = ((float)$nilai->nilai_total / 100.0) * 4;
            $temp->nilai_huruf = $this->parse_nilai($temp->nilai);
            array_push($data->nilai, $temp);

            $total += $temp->nilai;
            $hitung += 1;
            $total_sks += $temp->sks;
        }
        $data->ipk = number_format((float)($total / $hitung), 2, '.', '');
        $data->predikat = $this->parse_predikat($data->ipk);
        $data->total_sks = $total_sks;
        
        return view('akademik.transkrip.sementara', compact('data'));
    }

    public function kp(Request $request)
    {
        $mahasiswa = mahasiswa::find($request->id);
        $nilais = nilai::where('id_mahasiswa', $request->id)->get();

        $data = new \stdClass();
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
            $temp->nilai = ((float)$nilai->nilai_total / 100.0) * 4;
            $temp->nilai_huruf = $this->parse_nilai($temp->nilai);
            array_push($data->nilai, $temp);

            $total += $temp->nilai;
            $hitung += 1;
            $total_sks += $temp->sks;
        }
        $data->ipk = number_format((float)($total / $hitung), 2, '.', '');
        $data->predikat = $this->parse_predikat($data->ipk);
        $data->total_sks = $total_sks;
        
        return view('akademik.transkrip.kp', compact('data'));
    }

    public function ta(Request $request)
    {
        $mahasiswa = mahasiswa::find($request->id);
        $nilais = nilai::where('id_mahasiswa', $request->id)->get();

        $data = new \stdClass();
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
            $temp->nilai = ((float)$nilai->nilai_total / 100.0) * 4;
            $temp->nilai_huruf = $this->parse_nilai($temp->nilai);
            array_push($data->nilai, $temp);

            $total += $temp->nilai;
            $hitung += 1;
            $total_sks += $temp->sks;
        }
        $data->ipk = number_format((float)($total / $hitung), 2, '.', '');
        $data->predikat = $this->parse_predikat($data->ipk);
        $data->total_sks = $total_sks;
        
        return view('akademik.transkrip.ta', compact('data'));
    }

    public function takp(Request $request)
    {
        $mahasiswa = mahasiswa::find($request->id);
        $nilais = nilai::where('id_mahasiswa', $request->id)->get();

        $data = new \stdClass();
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
            $temp->nilai = ((float)$nilai->nilai_total / 100.0) * 4;
            $temp->nilai_huruf = $this->parse_nilai($temp->nilai);
            array_push($data->nilai, $temp);

            $total += $temp->nilai;
            $hitung += 1;
            $total_sks += $temp->sks;
        }
        $data->ipk = number_format((float)($total / $hitung), 2, '.', '');
        $data->predikat = $this->parse_predikat($data->ipk);
        $data->total_sks = $total_sks;
        
        return view('akademik.transkrip.takp', compact('data'));
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
        if($nilai == 4.0){
            return 'A';
        }
        if($nilai >= 3.5){
            return 'AB';
        }
        if($nilai >= 3.0){
            return 'B';
        }
        if($nilai >= 2.5){
            return 'BC';
        }
        if($nilai >= 2.0){
            return 'C';
        }
        if($nilai >= 1.0){
            return 'D';
        }
        if($nilai >= 0.0){
            return 'E';
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
}
