<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\masterAsisten;
use App\masterDosen;
use App\masterKelas;
use App\masterMK;

class Master extends Controller
{
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

    public function store_asisten(Request $request)
    {
        $asisten = new masterAsisten();
        $asisten->nrp = $request->nrp;
        $asisten->nama = $request->nama;
        $asisten->save();
    }

    public function store_dosen(Request $request)
    {
        $dosen = new masterDosen();
        $dosen->nama = $request->nama;
        $dosen->save();
    }

    public function store_kelas(Request $request)
    {
        $kelas = new masterKelas();
        $kelas->nama = $request->nama;
        $kelas->jam_SK = $request->jam_SK;
        $kelas->jam_J = $request->jam_J;
        $kelas->save();
    }

    public function store_mk(Request $request)
    {
        $mk = new masterMK();
        $mk->nama = $request->nama;
        $mk->semester = $request->semester;
        $mk->save();
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
        return view('master.kelas.edit', compact('data'));
    }

    public function edit_mk($id)
    {
        $data = masterMK::find($id);
        return view('master.mk.edit', compact('data'));
    }

    public function update_asisten(Request $request)
    {
        $asisten = masterAsisten::find($request->nrp);
        $asisten->nama = $request->nama;
        $asisten->save();
    }

    public function update_dosen(Request $request)
    {
        $dosen = masterDosen::find($request->id);
        $dosen->nama = $request->nama;
        $dosen->save();
    }

    public function update_kelas(Request $request)
    {
        $kelas = masterKelas::find($request->id);
        $kelas->nama = $request->nama;
        $kelas->jam_SK = $request->jam_SK;
        $kelas->jam_J = $request->jam_J;
        $kelas->save();
    }

    public function update_mk(Request $request)
    {
        $mk = masterMK::find($request->id);
        $mk->nama = $request->nama;
        $mk->semester = $request->semester;
        $mk->save();
    }

    public function delete_asisten(Request $request)
    {
        $asisten = masterAsisten::find($request->nrp);
        $asisten->delete();
    }

    public function delete_dosen(Request $request)
    {
        $dosen = masterDosen::find($request->id);
        $dosen->delete();
    }

    public function delete_kelas(Request $request)
    {
        $kelas = masterKelas::find($request->id);
        $kelas->delete();        
    }

    public function delete_mk(Request $request)
    {
        $mk = masterMK::find($request->find);
        $mk->delete();        
    }
}
