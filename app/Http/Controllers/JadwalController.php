<?php

namespace App\Http\Controllers;

use App\jadwal;
use App\mahasiswa;
use App\mahasiswa_jadwal;
use App\masterKelas;
use App\masterDosen;
use App\masterAsisten;
use App\masterMK;
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
        $jadwal->id_kelas = masterKelas::where('nama','=',$request->kelas)->first()->id;
        
        $mk = array();
        foreach($request->matkul as $matkul)
        {
            ($matkul) ? array_push($mk, $matkul) : array_push($mk, '0');
        }

        $dosen = array();
        foreach($request->dosen as $indvdosen)
        {
            ($indvdosen) ? array_push($dosen, $indvdosen) : array_push($dosen, '0');
        }

        $asisten = array();
        foreach($request->asisten as $indvasisten)
        {
            ($indvasisten) ? array_push($asisten, $indvasisten) : array_push($asisten, '0');
        }

        $jadwal->ids_mk = implode(',', $mk);
        $jadwal->ids_dosen = implode(',', $dosen);
        $jadwal->ids_asisten = implode(',', $asisten);

        $jadwal->save();
        return redirect()->route('jadwal');
    }

    public function edit(Request $request)
    {
        $data = new \stdClass();
        $jadwal = jadwal::find($request->id);
        $ids_mk = explode(',',$jadwal->ids_mk);
        $ids_dosen = explode(',',$jadwal->ids_dosen);
        $ids_asisten = explode(',',$jadwal->ids_asisten);
        
        $mk = array();
        foreach($ids_mk as $indvmk)
        {
            ($indvmk)?array_push($mk, $indvmk):array_push($mk, null);
        }

        $dosen = array();
        foreach($ids_dosen as $indvdosen)
        {
            ($indvdosen)?array_push($dosen, $indvdosen):array_push($dosen, null);
        }

        $asisten = array();
        foreach($ids_asisten as $indvasisten)
        {
            ($indvasisten)?array_push($asisten, $indvasisten):array_push($asisten, null);
        }

        $data->id = $request->id;
        $data->termin = $jadwal->termin;
        $data->kelas = masterKelas::find($jadwal->id_kelas)->nama;
        $data->matkul = $mk;
        $data->dosen = $dosen;
        $data->asisten = $asisten;
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
        $jadwal->id_kelas = masterKelas::where('nama','=',$request->kelas)->first()->id;
        
        $mk = array();
        foreach($request->matkul as $matkul)
        {
            ($matkul) ? array_push($mk, $matkul) : array_push($mk, '0');
        }

        $dosen = array();
        foreach($request->dosen as $indvdosen)
        {
            ($indvdosen) ? array_push($dosen, $indvdosen) : array_push($dosen, '0');
        }

        $asisten = array();
        foreach($request->asisten as $indvasisten)
        {
            ($indvasisten) ? array_push($asisten, $indvasisten) : array_push($asisten, '0');
        }

        $jadwal->ids_mk = implode(',', $mk);
        $jadwal->ids_dosen = implode(',', $dosen);
        $jadwal->ids_asisten = implode(',', $asisten);

        $jadwal->save();
        return redirect()->route('jadwal');
    }

    public function delete(Request $request)
    {
        $jadwal = jadwal::find($request->id);
        $jadwal->delete();
        return redirect()->route('jadwal');
    }

    public function detail($id)
    {
        $data = new \stdClass();
        $jadwal = jadwal::find($id);
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

        $data->id = $id;
        $data->termin = $jadwal->termin;
        $data->kelas = masterKelas::find($jadwal->id_kelas);
        $data->matkul = $mk;
        $data->dosen = $dosen;
        $data->asisten = $asisten;

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

            $temp->id = $id;
            $temp->termin = $jadwal->termin;
            $temp->kelas = masterKelas::find($jadwal->id_kelas);
            $temp->matkul = $mk;
            $temp->dosen = $dosen;
            $temp->asisten = $asisten;

            array_push($data->jadwal, $temp);
        }
        return view('akademik.jadwal.select', compact('data'));
    }

    public function SelectJadwal(Request $request)
    {
        $data = new mahasiswa_jadwal();
        $data->mahasiswa_id = $request->id_mahasiswa;
        $data->jadwal_id = $request->jadwal_id;
        $data->save();
        return redirect()->route('pembayaran.detail', ['id'=>$request->id_mahasiswa]);
    }
}