<?php

namespace App\Http\Controllers;

use App\angsuran;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = angsuran::all();
        return view('angsuran.index', compact('data'));
    }

    public function create()
    {
        return view('angsuran.create');
    }

    public function store(Request $request)
    {
        $angsuran = new angsuran();
        $angsuran->nama = $request->nama;
        $angsuran->gelombang = $request->gelombang;
        $angsuran->keterangan = $request->keterangan;
        // $angsuran->template here || need to discuss with front-end about data
        $angsuran->save();
        return redirect()->route('angsuran');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = angsuran::find($id);
        return view('angsuran.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $angsuran = angsuran::find($request->id);
        $angsuran->nama = $request->nama;
        $angsuran->gelombang = $request->gelombang;
        $angsuran->keterangan = $request->keterangan;
        // $angsuran->template here || need to discuss with front-end about data
        $angsuran->save();
        return redirect()->route('angsuran');
    }

    public function delete(Request $request)
    {
        $angsuran = angsuran::find($request->id);
        $angsuran->delete();
        return redirect()->route('angsuran');
    }
}
