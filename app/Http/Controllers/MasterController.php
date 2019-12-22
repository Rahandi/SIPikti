<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\masterAsisten;
use App\masterDosen;
use App\masterKelas;
use App\masterMK;
use App\masterGelombang;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_asisten()
    {
        $data = masterAsisten::all();
        return view('master.asisten.index', compact('data'));
    }

    public function index_dosen()
    {
        $data = masterDosen::all();
        return view('master.dosen.index', compact('data'));
    }

    public function index_mk()
    {
        $data = masterMK::all();
        return view('master.mk.index', compact('data'));
    }

    public function index_kelas()
    {
        $data = masterKelas::all();
        return view('master.kelas.index', compact('data'));
    }

    public function index_gelombang()
    {
        $data = masterGelombang::all();
        return view('master.gelombang.index', compact('data'));
    }

    public function create_asisten()
    {
        return view('master.asisten.create');
    }

    public function create_dosen()
    {
        return view('master.dosen.create');
    }

    public function create_mk()
    {
        return view('master.mk.create');
    }

    public function create_kelas()
    {
        return view('master.kelas.create');
    }

    public function create_gelombang()
    {
        return view('master.gelombang.create');
    }

    public function store_asisten(Request $request)
    {
        $asisten = new masterAsisten();
        $asisten->nrp = $request->nrp;
        $asisten->nama = $request->nama;
        $asisten->nohp = $request->nohp;
        $asisten->email = $request->email;
        $asisten->save();
        return redirect()->route('master.asisten.index');
    }

    public function store_dosen(Request $request)
    {
        $dosen = new masterDosen();
        $dosen->nama = $request->nama;
        $dosen->save();
        return redirect()->route('master.dosen.index');
    }

    public function store_kelas(Request $request)
    {
        $kelas = new masterKelas();
        $kelas->nama = $request->nama;
        $kelas->jam_SK = $request->start_SK.' - '.$request->end_SK;
        $kelas->jam_J = $request->start_J.' - '.$request->end_J;
        $kelas->save();
        return redirect()->route('master.kelas.index');
    }

    public function store_mk(Request $request)
    {
        $mk = new masterMK();
        $mk->kode_mk = $request->kode_mk;
        $mk->nama = $request->nama;
        $mk->semester = $request->semester;
        $mk->sks = $request->sks;
        $mk->save();
        return redirect()->route('master.mk.index');
    }

    public function store_gelombang(Request $request)
    {
        $gelombang = new masterGelombang();
        $gelombang->nama = $request->nama;
        $gelombang->mulai = $request->mulai;
        $gelombang->berakhir = $request->berakhir;
        $gelombang->save();
        return redirect()->route('master.gelombang.index');
    }

    public function edit_asisten($id)
    {
        $data = masterAsisten::find($id);
        return view('master.asisten.edit', compact('data'));
    }

    public function edit_dosen($id)
    {
        $data = masterDosen::find($id);
        return view('master.dosen.edit', compact('data'));
    }

    public function edit_kelas($id)
    {
        $data = masterKelas::find($id);
        $sk = explode(' - ', $data->jam_SK);
        $j = explode(' - ', $data->jam_J);
        $data->start_SK = $sk[0];
        $data->end_SK = $sk[1];
        $data->start_J = $j[0];
        $data->end_J = $j[1];
        return view('master.kelas.edit', compact('data'));
    }

    public function edit_mk($id)
    {
        $data = masterMK::find($id);
        return view('master.mk.edit', compact('data'));
    }

    public function edit_gelombang($id)
    {
        $data = masterGelombang::find($id);
        return view('master.gelombang.edit', compact('data'));
    }

    public function update_asisten(Request $request)
    {
        $asisten = masterAsisten::find($request->id);
        $asisten->nrp = $request->nrp;
        $asisten->nama = $request->nama;
        $asisten->save();
        return redirect()->route('master.asisten.index');
    }

    public function update_dosen(Request $request)
    {
        $dosen = masterDosen::find($request->id);
        $dosen->nama = $request->nama;
        $dosen->save();
        return redirect()->route('master.dosen.index');
    }

    public function update_kelas(Request $request)
    {
        $kelas = masterKelas::find($request->id);
        $kelas->nama = $request->nama;
        $kelas->jam_SK = $request->start_SK.' - '.$request->end_SK;
        $kelas->jam_J = $request->start_J.' - '.$request->end_J;
        $kelas->save();
        return redirect()->route('master.kelas.index');
    }

    public function update_mk(Request $request)
    {
        $mk = masterMK::find($request->id);
        $mk->kode_mk = $request->kode_mk;
        $mk->nama = $request->nama;
        $mk->semester = $request->semester;
        $mk->sks = $request->sks;
        $mk->save();
        return redirect()->route('master.mk.index');
    }

    public function update_gelombang(Request $request)
    {
        $gelombang = masterGelombang::find($request->id);
        $gelombang->nama = $request->nama;
        $gelombang->mulai = $request->mulai;
        $gelombang->berakhir = $request->berakhir;
        $gelombang->save();
        return redirect()->route('master.gelombang.index');
    }

    public function delete_asisten(Request $request)
    {
        $asisten = masterAsisten::find($request->nrp);
        $asisten->delete();
        return redirect()->route('master.asisten.index');
    }

    public function delete_dosen(Request $request)
    {
        $dosen = masterDosen::find($request->id);
        $dosen->delete();
        return redirect()->route('master.dosen.index');
    }

    public function delete_kelas(Request $request)
    {
        $kelas = masterKelas::find($request->id);
        $kelas->delete();        
        return redirect()->route('master.kelas.index');
    }

    public function delete_mk(Request $request)
    {
        $mk = masterMK::find($request->find);
        $mk->delete();        
        return redirect()->route('master.mk.index');
    }

    public function delete_gelombang(Request $request)
    {
        $gelombang = masterGelombang::find($request->id);
        $gelombang->delete();
        return redirect()->route('master.gelombang.index');
    }
}
