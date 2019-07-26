<?php

namespace App\Http\Controllers;

use App\jadwal;
use App\mahasiswa;
use App\mahasiswa_jadwal;
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
        $jadwal->kelas = $request->kelas;
        $jadwal->jam = $request->start_time.' - '.$request->end_time;
        $jadwal->mata_kuliah = $request->mata_kuliah;
        $jadwal->termin = $request->termin;
        $jadwal->save();
        return redirect()->route('jadwal');
    }

    public function edit(Request $request)
    {
        $data = jadwal::find($request->id);
        $time = explode(' - ', $data->jam);
        $data->start_time = $time[0];
        $data->end_time = $time[1];
        return view('akademik.jadwal.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $jadwal = jadwal::find($request->id);
        $jadwal->kelas = $request->kelas;
        $jadwal->jam = $request->start_time.' - '.$request->end_time;
        $jadwal->mata_kuliah = $request->mata_kuliah;
        $jadwal->termin = $request->termin;
        $jadwal->save();
        return redirect()->route('jadwal');
    }

    public function delete(Request $request)
    {
        $jadwal = jadwal::find($request->id);
        $jadwal->delete();
        return redirect()->route('jadwal');
    }

    public function detailJadwal($id)
    {
        $jadwal = jadwal::find($id);
        $sudah_diterima = \DB::table('mahasiswa')
                            ->join('mahasiswa_jadwal', 'mahasiswa.id', '=', 'mahasiswa_jadwal.mahasiswa_id')
                            ->select('mahasiswa.nrp', 'mahasiswa.nama')
                            ->where('mahasiswa_jadwal.jadwal_id', '=', $id)
                            ->get();
        $data = array(
            'jadwal' => $jadwal,
            'mahasiswa' => $sudah_diterima
        );
        return view('akademik.jadwal.detail', compact('data'));
    }

    public function pilihKelas($id)
    {
        $jadwal = jadwal::find($id);
        $belum_dapat = $this->belumDapatJadwal($id);
        $data = array(
            'jadwal' => $jadwal,
            'mahasiswa' => $belum_dapat
        );
        dd($data);
        return view('akademik.jadwal.pilih_kelas', compact('data'));
    }

    public function cancel(Request $request)
    {
        $record = mahasiswa_jadwal::where('mahasiswa_id', $request->mahasiswa_id)->where('jadwal_id', $request->jadwal_id);
        $record->delete();
        return redirect()->back();
    }

    private function belumDapatJadwal($id)
    {
        $sudah_dapat = \DB::table('mahasiswa_jadwal')
                            ->select('mahasiswa_jadwal.mahasiswa_id')
                            ->where('mahasiswa_jadwal.jadwal_id', '=', $id)
                            ->get();
        $notin = array();
        for($i=0;$i<count($sudah_dapat);$i++)
        {
            array_push($notin, $sudah_dapat[$i]->mahasiswa_id);
        }

        $belum_dapat = \DB::table('mahasiswa')
                            ->select('nrp', 'nama')
                            ->whereNotIn('id', $notin)
                            ->get();
        return $belum_dapat;
    }
}