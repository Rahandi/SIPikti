<?php

namespace App\Http\Controllers;

use App\mahasiswa;
use App\angsuran;
use App\mahasiswaAngsuran;
use Illuminate\Support\Facades\Auth;
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
            $datanya = unserialize($pembayaran->data_pembayaran);
            foreach($datanya as $key => $value){
                $datanya[$key]['biaya'] = strrev(rtrim(chunk_split(strrev($datanya[$key]['biaya']), 3, '.'), '.'));
            }
            $pembayaran->data_pembayaran = $datanya;
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
        return view('pembayaran.detail', compact('data'));
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
        $date = $this->get_date();
        $id_mahasiswa_angsuran = $request->mahasiswa_angsuran;
        $jenis_terbayar = $request->jenis_bayar;
        $mahasiswa_angsuran = mahasiswaAngsuran::find($id_mahasiswa_angsuran);
        $data_pembayaran = unserialize($mahasiswa_angsuran->data_pembayaran);
        $data_pembayaran[$jenis_terbayar]['tanda'] = 1;
        $data_pembayaran[$jenis_terbayar]['tanggal_bayar'] = $date;
        $mahasiswa_angsuran->data_pembayaran = serialize($data_pembayaran);
        $mahasiswa_angsuran->save();
        if ($jenis_terbayar == 'Daftar ulang 1'){
            $this->generateNRP($mahasiswa_angsuran->mahasiswa_id);            
        }
        $mahasiswa = mahasiswa::find($mahasiswa_angsuran->mahasiswa_id);
        $data = array(
            'nomer_pendaftaran' => $mahasiswa->nomor_pendaftaran,
            'nama' => $mahasiswa->nama,
            'nrp' => $mahasiswa->nrp,
            'nama_pembayaran' => $jenis_terbayar,
            'biaya' => $data_pembayaran[$jenis_terbayar]['biaya'],
            'terbilang' => $data_pembayaran[$jenis_terbayar]['terbilang'],
            'date' => $date,
            'administrator' => Auth::user()->name
        );
        return view('pembayaran.kwitansi', compact('data'));
    }

    public function rekap()
    {
        $data = \DB::table('mahasiswa_angsuran')
        ->join('mahasiswa', 'mahasiswa_angsuran.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('angsuran', 'mahasiswa_angsuran.angsuran_id', '=', 'angsuran.id')
        ->select('mahasiswa.nrp', 'mahasiswa.nama', 'angsuran.nama as angsuran_nama', 'mahasiswa_angsuran.data_pembayaran')
        ->get();
        for($i=0;$i<count($data);$i++){
            $data[$i]->data_pembayaran = unserialize($data[$i]->data_pembayaran);
            // disintegrate pembayaran
            $data_pembayaran = array(
                "Daftar ulang 1" => $data[$i]->data_pembayaran['Daftar ulang 1']['tanda'],
                "Daftar ulang 2" => $data[$i]->data_pembayaran['Daftar ulang 2']['tanda']
            );
            for($j=1;$j<=5;$j++){
                $angsuran = "Angsuran ".$j;
                $data_pembayaran[$angsuran] = isset($data[$i]->data_pembayaran[$angsuran]) ? $data[$i]->data_pembayaran[$angsuran]['tanda'] : -1;
            }
            $data[$i]->data_pembayaran = $data_pembayaran;
        }
        
        return view('pembayaran.rekap', compact('data'));
    }

    public function download()
    {

    }

    public function generateNRP($id_mahasiswa)
    {
        $tahun = date('Y');
        $tahun = substr($tahun, 2, strlen($tahun));

        $nrp_mahasiswa = \DB::table('mahasiswa')
                            ->select('mahasiswa.nrp')
                            ->orderBy('mahasiswa.nrp', 'DESC')
                            ->take(1)
                            ->get();
        $sekarang = $nrp_mahasiswa[0]->nrp;
        $sekarang = substr($sekarang, 7);
        $urutan = $sekarang+1;
        $urutan = str_pad($urutan, 3, '0', 0);

        $nrp = '88'.$tahun.'200'.$urutan;

        $mahasiswa = mahasiswa::find($id_mahasiswa);
        $mahasiswa->nrp = $nrp;
        $mahasiswa->save();
        return redirect()->back();
    }

    private function get_date()
    {
        $month = date("F");
        if ($month == 'January'){
            $month = 'Januari';
        }
        elseif ($month == 'February'){
            $month = 'Februari';
        }
        elseif ($month == 'March'){
            $month = 'Maret';
        }
        elseif ($month == 'May'){
            $month = 'Mei';
        }
        elseif ($month == 'June'){
            $month = 'Juni';
        }
        elseif ($month == 'July'){
            $month = 'Juli';
        }
        elseif ($month == 'August'){
            $month = 'Agustus';
        }
        elseif ($month == 'October'){
            $month = 'Oktober';
        }
        elseif ($month == 'December'){
            $month = 'Desember';
        }
        $date = date('d ').$month.date(' Y');
        return $date;
    }
}
