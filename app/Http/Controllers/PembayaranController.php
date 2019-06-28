<?php

namespace App\Http\Controllers;

use App\mahasiswa;
use App\angsuran;
use App\mahasiswaAngsuran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = mahasiswa::all();
        return view('pembayaran.index', compact('data'));
    }

    public function detail(Request $request)
    {
        $pembayaran = mahasiswaAngsuran::where('mahasiswa_id', $request->id)->get()->first();
        if ($pembayaran)
        {
            $pembayaran->data_pembayaran = unserialize($pembayaran->data_pembayaran);
            $data = array(
                "mahasiswa" => mahasiswa::find($request->id),
                "exist" => 1,
                "pembayaran" => $pembayaran,
                "angsuran" => angsuran::find($pembayaran->angsuran_id)
            );
            return view('pembayaran.detail', compact('data'));
        }
        $data = array(
            "mahasiswa" => mahasiswa::find($request->id),
            "exist" => 0,
            "angsuran" => angsuran::all()
        );
        return view('detail_pembayaran', compact('data'));
    }

    public function selectAngsuran(Request $request)
    {
        $id_angsuran = $request->id_angsuran;
        $id_mahasiswa = $request->id_mahasiswa;

        $angsuran = angsuran::find($id_angsuran);

        $mahasiswa_angsuran = new mahasiswaAngsuran();
        $mahasiswa_angsuran->mahasiswa_id = $id_mahasiswa;
        $mahasiswa_angsuran->angsuran_id = $id_angsuran;
        $mahasiswa_angsuran->data_pembayaran = $angsuran->template;
        $mahasiswa_angsuran->save();
        return redirect()->back();
    }

    public function bayarAngsuran(Request $request)
    {
        $id_mahasiswa_angsuran = $request->mahasiswa_angsuran;
        $jenis_terbayar = $request->jenis_bayar;
        $mahasiswa_angsuran = mahasiswaAngsuran::find($id_mahasiswa_angsuran);
        $data_pembayaran = $mahasiswa_angsuran->data_pembayaran;
        $data_pembayaran[$jenis_terbayar]['tanda'] = 1;
        $mahasiswa_angsuran->data_pembayaran = $data_pembayaran;
        $mahasiswa_angsuran->save();
        return redirect()->back()->with('status', 'Pembayaran Sukses');
    }
}
