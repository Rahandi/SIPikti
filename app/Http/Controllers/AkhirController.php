<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\akhir_kompre;
use App\akhir_kp;
use App\akhir_pa;
use App\akhir_pakp;
use App\jadwal;
use App\masterKelas;
use App\mahasiswa;

class AkhirController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = jadwal::distinct()->get(['tahun']);
        return view('akademik/pakp/index');
    }

    public function detail($jenis, $tahun)
    {
        if($jenis == 'pa')
        {
            $master = akhir_pa::where('tahun', $tahun)->get();

            $data = [];
            foreach($master as $akhir)
            {
                $jadwal = jadwal::find($akhir->jadwal_id);
                $kelas = masterKelas::find($jadwal->id_kelas)->nama;

                $mahasiswa = mahasiswa::find($akhir->mahasiswa_id);

                $temp = new \stdClass();
                $temp->kelas = $kelas;
                $temp->mhs_id = $mahasiswa->id;
                $temp->nrp = $mahasiswa->nrp;
                $temp->nama = $mahasiswa->nama;
                $temp->judul = $akhir->judul;
                $temp->pembimbing = $akhir->pembimbing;
                $temp->nilai = $akhir->nilai;

                array_push($data, $temp);
            }

            return view('akademik.pakp.pa.index');
        }
        elseif($jenis == 'kp')
        {
            $master = akhir_kp::where('tahun', $tahun)->get();

            $data = [];
            foreach($master as $akhir)
            {
                $jadwal = jadwal::find($akhir->jadwal_id);
                $kelas = masterKelas::find($jadwal->id_kelas)->nama;

                $mahasiswa = mahasiswa::find($akhir->mahasiswa_id);

                $temp = new \stdClass();
                $temp->kelas = $kelas;
                $temp->mhs_id = $mahasiswa->id;
                $temp->nrp = $mahasiswa->nrp;
                $temp->nama = $mahasiswa->nama;
                $temp->nilai = $akhir->nilai;

                array_push($data, $temp);
            }

            return view('akademik.pakp.kp.index');
        }
        elseif($jenis == 'pakp')
        {
            $master = akhir_pakp::where('tahun', $tahun)->get();

            $data = [];
            foreach($master as $akhir)
            {
                $jadwal = jadwal::find($akhir->jadwal_id);
                $kelas = masterKelas::find($jadwal->id_kelas)->nama;

                $mahasiswa = mahasiswa::find($akhir->mahasiswa_id);

                $temp = new \stdClass();
                $temp->kelas = $kelas;
                $temp->mhs_id = $mahasiswa->id;
                $temp->nrp = $mahasiswa->nrp;
                $temp->nama = $mahasiswa->nama;
                $temp->judul = $akhir->judul;
                $temp->pembimbing = $akhir->pembimbing;
                $temp->nilai_pa = $akhir->nilai_pa;
                $temp->nilai_kp = $akhir->nilai_kp;

                array_push($data, $temp);
            }

            return view('akademik.pakp.kp.index');
        }
        elseif($jenis == 'kompre')
        {
            $master = akhir_kompre::where('tahun', $tahun)->get();

            $data = [];
            foreach($master as $akhir)
            {
                $jadwal = jadwal::find($akhir->jadwal_id);
                $kelas = masterKelas::find($jadwal->id_kelas)->nama;

                $mahasiswa = mahasiswa::find($akhir->mahasiswa_id);

                $temp = new \stdClass();
                $temp->kelas = $kelas;
                $temp->mhs_id = $mahasiswa->id;
                $temp->nrp = $mahasiswa->nrp;
                $temp->nama = $mahasiswa->nama;
                $temp->nilai = $akhir->nilai;

                array_push($data, $temp);
            }

            return view('akademik.pakp.kompre.index');
        }

        return redirect()->back();
    }

    public function pilih_mhs_pa()
    {

    }

    private function get_mhs_without_akhir()
    {
        $mhs_pa = akhir_pa::all();
        $mhs_kp = akhir_kp::all();
        $mhs_pakp = akhir_pakp::all();
        $mhs_kompre = akhir_kompre::all();

        $mahasiswa_ids = [];
        foreach ($mhs_pa as $mhs) {
            array_push($mahasiswa_ids, $mhs->mahasiswa_id);
        }
        foreach ($mhs_kp as $mhs) {
            array_push($mahasiswa_ids, $mhs->mahasiswa_id);
        }
        foreach ($mhs_pakp as $mhs) {
            array_push($mahasiswa_ids, $mhs->mahasiswa_id);
        }
        foreach ($mhs_kompre as $mhs) {
            array_push($mahasiswa_ids, $mhs->mahasiswa_id);
        }

        $mahasiswa = mahasiswa::whereNotIn('id', $mahasiswa_ids)
                        ->where('nrp', '!=', null)
                        ->get();

        return $mahasiswa;
    }
}
