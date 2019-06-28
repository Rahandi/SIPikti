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
        for($i=0;$i<count($data);$i++){
            $data[$i]->template = unserialize($data[$i]->template);
            $keterangan = array();
            foreach ($data[$i]->template as $key => $value) {
                array_push($keterangan, $key.': '.$value['biaya']);
            }
            $data[$i]->detail = implode('; ', $keterangan);
        }
        return view('angsuran.index', compact('data'));
    }

    public function create()
    {
        return view('angsuran.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $angsuran = new angsuran();
        $angsuran->nama = $request->nama;
        $angsuran->gelombang = $request->gelombang;
        $angsuran->keterangan = $request->keterangan;
        $angsuran->kali_angsuran = $request->kali_pembayaran;
        $prefix = 'a';
        $template = array();
        $template['Daftar ulang 1'] = array('biaya' => $request->du1, 'tanda' => 0);
        $template['Daftar ulang 2'] = array('biaya' => $request->du2, 'tanda' => 0);
        for($i=1; $i<=$request['kali_pembayaran']; $i++){
            $jadi = $prefix.$i;
            $template['Angsuran'.$i] = array('biaya' => $request[$jadi], 'tanda' => 0);
        }
        $angsuran->template = serialize($template);
        $angsuran->save();
        return redirect()->route('angsuran');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = angsuran::find($id);
        $data->template = unserialize($data->template);
        return view('angsuran.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $angsuran = angsuran::find($request->id);
        $angsuran->nama = $request->nama;
        $angsuran->gelombang = $request->gelombang;
        $angsuran->keterangan = $request->keterangan;
        $prefix = 'a';
        $template = array();
        $template['Daftar ulang 1'] = array('biaya' => $request->du1, 'tanda' => 0);
        $template['Daftar ulang 2'] = array('biaya' => $request->du2, 'tanda' => 0);
        for($i=1; $i<=$request['kali_pembayaran']; $i++){
            $jadi = $prefix.$i;
            $template['Angsuran'.$i] = array('biaya' => $request[$jadi], 'tanda' => 0);
        }
        $angsuran->template = serialize($template);
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
