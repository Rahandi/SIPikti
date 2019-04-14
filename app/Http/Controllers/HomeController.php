<?php

namespace App\Http\Controllers;

use App\pendaftar;
use App\pendidikan;
use App\statusSaatMendaftar;
use App\alamat;
use App\sumberInformasi;
use App\noPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function list()
    {
        $data = pendaftar::all();
        return view('list', compact('data'));
    }

    public function kwitansi($id)
    {
        $data = pendaftar::find($id);
        return view('kwitansi', compact('data'));
    }

    public function detail($id)
    {
        $data = $this->getPendaftarFullDetails($id);
        return view('show', compact('data'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data_utama = pendaftar::find($id);
        $data_alamat_asal = alamat::find($data_utama->alamat_asal_id);
        $data_alamat_surabaya = alamat::find($data_utama->alamat_surabaya_id);
        $data_status_saat_mendaftar = statusSaatMendaftar::find($data_utama->status_saat_mendaftar_id);
        $data_sumber_informasi = sumberInformasi::find($data_utama->sumber_informasi_id);

        $pendidikan_id = unserialize($data_utama->pendidikan_id);
        $data_pendidikan = array();
        foreach($pendidikan_id as $key => $value)
        {
            $data_pendidikan[$key] = pendidikan::find($value);
        }

        $data = $data_utama;
        $data['pendidikan'] = (object)$data_pendidikan;
        $data['alamat_asal'] = $data_alamat_asal;
        $data['alamat_surabaya'] = $data_alamat_surabaya;
        $data['status_saat_mendaftar'] = $this->statusSaatMendaftarTranslator($data_status_saat_mendaftar);
        $data['sumber_informasi'] = $this->sumberInformasiTranslator($data_sumber_informasi);
        dd($data);        
        return view('edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = pendaftar::find();
    }

    public function verifikasi(Request $request)
    {
        $id = $request->id;
        $pendaftar = pendaftar::find($id);
        $pendaftar->nomor_pendaftaran = $this->generateNoPendaftaran();
        $pendaftar->administrator = Auth::user()->name;
        $pendaftar->save();
        return redirect()->back();
    }

    public function deletePendaftar(Request $request)
    {
        $id = $request->id;
        $data_utama = pendaftar::find($id);
        $data_alamat_asal = alamat::find($data_utama->alamat_asal_id);
        $data_alamat_surabaya = alamat::find($data_utama->alamat_surabaya_id);
        $data_status_saat_mendaftar = statusSaatMendaftar::find($data_utama->status_saat_mendaftar_id);
        $data_sumber_informasi = sumberInformasi::find($data_utama->sumber_informasi_id);

        $pendidikan_id = unserialize($data_utama->pendidikan_id);
        $data_pendidikan = array();
        foreach($pendidikan_id as $key => $value)
        {
            array_push($data_pendidikan, pendidikan::find($value));
        }

        $data_utama->delete();
        $data_alamat_asal->delete();
        $data_alamat_surabaya->delete();
        $data_status_saat_mendaftar->delete();
        $data_sumber_informasi->delete();
        foreach($data_pendidikan as $pendidikan)
        {
            $pendidikan->delete();
        }

        return redirect()->route('list');
    }

    private function generateNoPendaftaran()
    {
        $current_year = date('Y');
        $current_year = substr($current_year, 2, strlen($current_year));
        $tahun_angkatan = date('Y', strtotime('+10 year'));
        $tahun_angkatan = substr($tahun_angkatan, 2, strlen($tahun_angkatan));
        $tahun_angkatan = $this->numberToRomanRepresentation((int)$tahun_angkatan);
        $no_pendaftaran = $tahun_angkatan.'/'.$current_year.'/'.'PIKTI'.'/';
        $no_urut = noPendaftaran::where('tahun', date('Y'))->take(1)->get();
        if (count($no_urut)) {
            $no_urut = $no_urut[0];
            $no_pendaftaran = $no_pendaftaran.str_pad($no_urut->nomor, 3, '0', STR_PAD_LEFT);
            $no_urut->nomor = (string)((int)$no_urut->nomor + 1);
            $no_urut->save();
        }
        else {
            $no_pendaftaran = $no_pendaftaran.'001';
            $no_urut = new noPendaftaran();
            $no_urut->tahun = date('Y');
            $no_urut->nomor = '2';
            $no_urut->save();
        }
        return $no_pendaftaran;
    }

    private function numberToRomanRepresentation($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    private function getPendaftarFullDetails($id) {
        $data_utama = pendaftar::find($id);
        $data_utama->tanggal_lahir = date('d F Y', strtotime($data_utama->tanggal_lahir));
        $data_alamat_asal = alamat::find($data_utama->alamat_asal_id);
        $data_alamat_surabaya = alamat::find($data_utama->alamat_surabaya_id);
        $data_status_saat_mendaftar = statusSaatMendaftar::find($data_utama->status_saat_mendaftar_id);
        $data_sumber_informasi = sumberInformasi::find($data_utama->sumber_informasi_id);

        $pendidikan_id = unserialize($data_utama->pendidikan_id);
        $data_pendidikan = array();
        foreach($pendidikan_id as $key => $value)
        {
            array_push($data_pendidikan, pendidikan::find($value));
        }

        $data = $data_utama;
        $data['pendidikan'] = (object)$data_pendidikan;
        $data['alamat_asal'] = $data_alamat_asal;
        $data['alamat_surabaya'] = $data_alamat_surabaya;
        $data['status_saat_mendaftar'] = $this->statusSaatMendaftarTranslator($data_status_saat_mendaftar);
        $data['sumber_informasi'] = $this->sumberInformasiTranslator($data_sumber_informasi);
        return $data;
    }

    private function statusSaatMendaftarTranslator($data)
    {
        if($data->lulus_sma){return "lulus sma";}
        if($data->mahasiswa){return "mahasiswa";}
        if($data->bekerja){return "bekerja";}
    }

    private function sumberInformasiTranslator($data)
    {
        if($data->koran){return "koran";}
        if($data->spanduk){return "spanduk";}
        if($data->brosur){return "brosur";}
        if($data->teman_saudara){return "teman/saudara";}
        if($data->pameran){return "pameran";}
        if($data->lainnya){return "lainnya";}
    }
}
