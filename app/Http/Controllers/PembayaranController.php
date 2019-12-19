<?php

namespace App\Http\Controllers;

use App\mahasiswa;
use App\angsuran;
use App\jadwal;
use App\masterKelas;
use App\mahasiswaAngsuran;
use App\mahasiswaJadwal;
use App\Exports\RekapExport;
use Maatwebsite\Excel\Facades\Excel;
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
                $datanya[$key]['tanggal_asli'] = $this->parse_date_to_number($datanya[$key]['tanggal_bayar']);
            }
            $pembayaran->data_pembayaran = $datanya;
            $data = array(
                "mahasiswa" => mahasiswa::find($request->id),
                "exist" => 1,
                "pembayaran" => $pembayaran,
                "angsuran" => angsuran::find($pembayaran->angsuran_id),
                "kelas" => NULL,
                "jadwal" => NULL
            );
            $mahasiswa_jadwal = mahasiswaJadwal::where('mahasiswa_id', '=', $request->id)->get()->first();
            if($mahasiswa_jadwal) {
                $jadwal = jadwal::find($mahasiswa_jadwal->jadwal_id);
                $data['kelas'] = masterKelas::find($jadwal->id_kelas)->nama;
                $data['jadwal'] = $jadwal;
            }
            return view('pembayaran.detail', compact('data'));
        }
        $data = array(
            "mahasiswa" => mahasiswa::find($request->id),
            "exist" => 0,
            "kelas" => NULL,
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
        $angsuran = angsuran::find($mahasiswa_angsuran->angsuran_id);
        $data = array(
            'nomer_pendaftaran' => $mahasiswa->nomor_pendaftaran,
            'nama' => $mahasiswa->nama,
            'nrp' => $mahasiswa->nrp,
            'gelombang' => $angsuran->gelombang,
            'cara' => $angsuran->nama,
            'nama_pembayaran' => $jenis_terbayar,
            'biaya' => strrev(rtrim(chunk_split(strrev($data_pembayaran[$jenis_terbayar]['biaya']), 3, '.'), '.')),
            'terbilang' => $data_pembayaran[$jenis_terbayar]['terbilang'],
            'date' => $date,
            'administrator' => Auth::user()->name
        );
        return view('pembayaran.kwitansi', compact('data'));
    }

    public function ubahTanggal(Request $request)
    {
        $date = $request->tglbayar;
        $date = $this->parse_date_to_indo($date);
        $id_mahasiswa_angsuran = $request->mahasiswa_angsuran;
        $jenis_terbayar = $request->jenis_bayar;
        $mahasiswa_angsuran = mahasiswaAngsuran::find($id_mahasiswa_angsuran);
        $data_pembayaran = unserialize($mahasiswa_angsuran->data_pembayaran);
        $data_pembayaran[$jenis_terbayar]['tanggal_bayar'] = $date;
        $mahasiswa_angsuran->data_pembayaran = serialize($data_pembayaran);
        $mahasiswa_angsuran->save();

        return redirect()->back();
    }

    public function deleteBayarAngsuran(Request $request)
    {
        $id_mahasiswa_angsuran = $request->mahasiswa_angsuran;
        $jenis_bayar = $request->jenis_bayar;
        $mahasiswa_angsuran = mahasiswaAngsuran::find($id_mahasiswa_angsuran);
        $data_pembayaran = unserialize($mahasiswa_angsuran->data_pembayaran);
        $data_pembayaran[$jenis_bayar]['tanda'] = 0;
        $data_pembayaran[$jenis_bayar]['tanggal_bayar'] = NULL;
        $mahasiswa_angsuran->data_pembayaran = serialize($data_pembayaran);
        $mahasiswa_angsuran->save();
        return redirect()->back();
    }

    public function kwitansi(Request $request)
    {
        $jenis_terbayar = $request->jenis_bayar;
        $mahasiswa_angsuran = mahasiswaAngsuran::find($request->mahasiswa_angsuran);
        $mahasiswa = mahasiswa::find($mahasiswa_angsuran->mahasiswa_id);
        $angsuran = angsuran::find($mahasiswa_angsuran->angsuran_id);
        $data_pembayaran = unserialize($mahasiswa_angsuran->data_pembayaran);
        $data = array(
            'nomer_pendaftaran' => $mahasiswa->nomor_pendaftaran,
            'nama' => $mahasiswa->nama,
            'nrp' => $mahasiswa->nrp,
            'nama_pembayaran' => $jenis_terbayar,
            'gelombang' => $angsuran->gelombang,
            'cara' => $angsuran->nama,
            'biaya' => strrev(rtrim(chunk_split(strrev($data_pembayaran[$jenis_terbayar]['biaya']), 3, '.'), '.')),
            'terbilang' => $data_pembayaran[$jenis_terbayar]['terbilang'],
            'date' => $data_pembayaran[$jenis_terbayar]['tanggal_bayar'],
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
        return Excel::download(new RekapExport(), 'rekap.xlsx');
    }

    private function generateNRP($id_mahasiswa)
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
        if($mahasiswa->nrp == NULL)
        {
            $mahasiswa->nrp = $nrp;
            $mahasiswa->save();
        }
    }

    private function parse_date_to_indo($date)
    {
        $parted = explode('-', $date);
        if ($parted[1] == '01')
        {
            $parted[1] = 'Januari';
        }
        elseif ($parted[1] == '02')
        {
            $parted[1] = 'Februari';
        }
        elseif ($parted[1] == '03')
        {
            $parted[1] = 'Maret';
        }
        elseif ($parted[1] == '04')
        {
            $parted[1] = 'April';
        }
        elseif ($parted[1] == '05')
        {
            $parted[1] = 'Mei';
        }
        elseif ($parted[1] == '06')
        {
            $parted[1] = 'Juni';
        }
        elseif ($parted[1] == '07')
        {
            $parted[1] = 'Juli';
        }
        elseif ($parted[1] == '08')
        {
            $parted[1] = 'Agustus';
        }
        elseif ($parted[1] == '09')
        {
            $parted[1] = 'September';
        }
        elseif ($parted[1] == '10')
        {
            $parted[1] = 'Oktober';
        }
        elseif ($parted[1] == '11')
        {
            $parted[1] = 'November';
        }
        elseif ($parted[1] == '12')
        {
            $parted[1] = 'Desember';
        }
        $diwalik = [$parted[2], $parted[1], $parted[0]];
        return implode(' ', $diwalik);
    }

    private function parse_date_to_number($date)
    {
        if($date)
        {
            $parted = explode(' ', $date);
            if ($parted[1] == 'Januari')
            {
                $parted[1] = '01';
            }
            elseif ($parted[1] == 'Februari')
            {
                $parted[1] = '02';
            }
            elseif ($parted[1] == 'Maret')
            {
                $parted[1] = '03';
            }
            elseif ($parted[1] == 'April')
            {
                $parted[1] = '04';
            }
            elseif ($parted[1] == 'Mei')
            {
                $parted[1] = '05';
            }
            elseif ($parted[1] == 'Juni')
            {
                $parted[1] = '06';
            }
            elseif ($parted[1] == 'Juli')
            {
                $parted[1] = '07';
            }
            elseif ($parted[1] == 'Agustus')
            {
                $parted[1] = '08';
            }
            elseif ($parted[1] == 'September')
            {
                $parted[1] = '09';
            }
            elseif ($parted[1] == 'Oktober')
            {
                $parted[1] = '10';
            }
            elseif ($parted[1] == 'November')
            {
                $parted[1] = '11';
            }
            elseif ($parted[1] == 'Desember')
            {
                $parted[1] = '12';
            }
            $diwalik = [$parted[2], $parted[1], $parted[0]];
            return implode('-', $diwalik);
        }
        else
        {
            return $date;
        }
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
