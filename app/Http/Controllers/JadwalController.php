<?php

namespace App\Http\Controllers;

use App\jadwal;
use App\mahasiswa;
use App\mahasiswa_jadwal;
use App\masterKelas;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = jadwal::all();
        return view('akademik.jadwal.index', compact('data'));
    }

    public function create()
    {
        return view('akademik.jadwal.create');
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
        $data = new stdClass();
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

        $data->termin = $jadwal->termin;
        $data->kelas = masterKelas::find($jadwal->id_kelas)->nama;
        $data->matkul = $mk;
        $data->dosen = $dosen;
        $data->asisten = $asisten;

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
}