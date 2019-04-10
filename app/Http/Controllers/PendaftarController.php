<?php

namespace App\Http\Controllers;

use App\pendaftar;
use App\pendidikan;
use App\statusSaatMendaftar;
use App\alamat;
use App\sumberInformasi;
use App\noPendaftaran;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = pendaftar::all();
        return view('list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('daftar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data_pendidikan = array();

        //bagian data pribadi
        $table_daftar = new pendaftar();
        $table_daftar->administrator = $request->administrator;
        $table_daftar->nomor_pendaftaran = $this->generateNoPendaftaran();
        $table_daftar->nama = $request->nama;
        $table_daftar->nama_gelar = $request->nama_gelar;
        $table_daftar->tempat_lahir = $request->tempat_lahir;
        $table_daftar->tanggal_lahir = $request->tanggal_lahir;
        $table_daftar->jenis_kelamin = $request->jenis_kelamin;
        $table_daftar->agama = $request->agama;
        $table_daftar->status_perkawinan = $request->status_perkawinan;
        $table_daftar->nomor_handphone = $request->nomor_handphone;

        //bagian alamat
        ///alamat asal
        $table_alamat = new alamat();
        $table_alamat->jalan = $request->asal_jalan;
        $table_alamat->kelurahan = $request->asal_kelurahan;
        $table_alamat->kecamatan = $request->asal_kecamatan;
        $table_alamat->kabupaten = $request->asal_kabupaten;
        $table_alamat->kode_pos = $request->asal_kode_pos;
        $table_alamat->telepon = $request->asal_telepon;
        $table_alamat->save();
        $table_daftar->alamat_asal_id = $table_alamat->id;
        ///alamat surabaya
        $table_alamat = new alamat();
        $table_alamat->jalan = $request->surabaya_jalan;
        $table_alamat->kelurahan = $request->surabaya_kelurahan;
        $table_alamat->kecamatan = $request->surabaya_kecamatan;
        $table_alamat->kabupaten = $request->surabaya_kabupaten;
        $table_alamat->kode_pos = $request->surabaya_kode_pos;
        $table_alamat->telepon = $request->surabaya_telepon;
        $table_alamat->save();
        $table_daftar->alamat_surabaya_id = $table_alamat->id;

        //bagian pendidikan
        if (isset($request->sd_institusi, $request->sd_bidang_studi, $request->sd_tahun_masuk, $request->sd_tahun_lulus)) {
            $table_pendidikan = new pendidikan();
            $table_pendidikan->jenjang_pendidikan = 'sd';
            $table_pendidikan->institusi = $request->sd_institusi;
            $table_pendidikan->bidang_studi = $request->sd_bidang_studi;
            $table_pendidikan->tahun_masuk = $request->sd_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->sd_tahun_lulus;
            $table_pendidikan->save();
            $data_pendidikan['sd'] = $table_pendidikan->id;
        }
        
        if (isset($request->sltp_institusi, $request->sltp_bidang_studi, $request->sltp_tahun_masuk, $request->sltp_tahun_lulus)) {
            $table_pendidikan = new pendidikan();
            $table_pendidikan->jenjang_pendidikan = 'sltp';
            $table_pendidikan->institusi = $request->sltp_institusi;
            $table_pendidikan->bidang_studi = $request->sltp_bidang_studi;
            $table_pendidikan->tahun_masuk = $request->sltp_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->sltp_tahun_lulus;
            $table_pendidikan->save();
            $data_pendidikan['sltp'] = $table_pendidikan->id;
        }

        if (isset($request->slta_institusi, $request->slta_bidang_studi, $request->slta_tahun_masuk, $request->slta_tahun_lulus)) {
            $table_pendidikan = new pendidikan();
            $table_pendidikan->jenjang_pendidikan = 'slta';
            $table_pendidikan->institusi = $request->slta_institusi;
            $table_pendidikan->bidang_studi = $request->slta_bidang_studi;
            $table_pendidikan->tahun_masuk = $request->slta_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->slta_tahun_lulus;
            $table_pendidikan->save();
            $data_pendidikan['slta'] = $table_pendidikan->id;
        }

        if (isset($request->diploma_institusi, $request->diploma_bidang_studi, $request->diploma_tahun_masuk, $request->diploma_tahun_lulus)) {
            $table_pendidikan = new pendidikan();
            $table_pendidikan->jenjang_pendidikan = 'diploma';
            $table_pendidikan->institusi = $request->diploma_institusi;
            $table_pendidikan->bidang_studi = $request->diploma_bidang_studi;
            $table_pendidikan->tahun_masuk = $request->diploma_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->diploma_tahun_lulus;
            $table_pendidikan->save();
            $data_pendidikan['diploma'] = $table_pendidikan->id;
        }

        if (isset($request->sarjana_institusi, $request->sarjana_bidang_studi, $request->sarjana_tahun_masuk, $request->sarjana_tahun_lulus)) {
            $table_pendidikan = new pendidikan();
            $table_pendidikan->jenjang_pendidikan = 'sarjana';
            $table_pendidikan->institusi = $request->sarjana_institusi;
            $table_pendidikan->bidang_studi = $request->sarjana_bidang_studi;
            $table_pendidikan->tahun_masuk = $request->sarjana_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->sarjana_tahun_lulus;
            $table_pendidikan->save();
            $data_pendidikan['sarjana'] = $table_pendidikan->id;
        }

        if (isset($request->lainnya_institusi, $request->lainnya_bidang_studi, $request->lainnya_tahun_masuk, $request->lainnya_tahun_lulus)) {
            $table_pendidikan = new pendidikan();
            $table_pendidikan->jenjang_pendidikan = 'lainnya';
            $table_pendidikan->institusi = $request->lainnya_institusi;
            $table_pendidikan->bidang_studi = $request->lainnya_bidang_studi;
            $table_pendidikan->tahun_masuk = $request->lainnya_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->lainnya_tahun_lulus;
            $table_pendidikan->save();
            $data_pendidikan['lainnya'] = $table_pendidikan->id;
        }

        $table_daftar->pendidikan_id = serialize($data_pendidikan);

        //bagian status saat mendaftar
        $table_status_saat_mendaftar = new statusSaatMendaftar();
        $table_status_saat_mendaftar->lulus_sma = (isset($request->lulus_sma)) ? 1 : 0;
        $table_status_saat_mendaftar->mahasiswa = (isset($request->mahasiswa)) ? 1 : 0;
        $table_status_saat_mendaftar->bekerja = (isset($request->bekerja)) ? 1 : 0;
        $table_status_saat_mendaftar->save();

        $table_daftar->status_saat_mendaftar_id = $table_status_saat_mendaftar->id;

        //bagian sumber informasi
        $table_sumber_informasi = new sumberInformasi();
        $table_sumber_informasi->koran = (isset($request->koran)) ? 1 : 0;
        $table_sumber_informasi->spanduk = (isset($request->spanduk)) ? 1 : 0;
        $table_sumber_informasi->brosur = (isset($request->brosur)) ? 1 : 0;
        $table_sumber_informasi->teman_saudara = (isset($request->teman_saudara)) ? 1 : 0;
        $table_sumber_informasi->pameran = (isset($request->pameran)) ? 1 : 0;
        $table_sumber_informasi->lainnya = (isset($request->lainnya)) ? 1 : 0;
        $table_sumber_informasi->save();

        $table_daftar->sumber_informasi_id = $table_sumber_informasi->id;

        $table_daftar->save();

        $data = $table_daftar;
        return $this->show($data->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this.getPendaftarFullDetails($id);
        return view('show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this.getPendaftarFullDetails($id);
        return view('edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pendaftar $pendaftar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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

        return 'ok';
    }

    public function kwitansi($id)
    {
        $data = pendaftar::find($id);
        return view('kwitansi', compact('data'));
    }

    public function generateNoPendaftaran()
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
            $no_pendaftaran = $no_pendaftaran.$no_urut->nomor;
            $no_urut->nomor = (string)((int)$no_urut->nomor + 1);
            $no_urut->save();
        }
        else {
            $no_pendaftaran = $no_pendaftaran.'1';
            $no_urut = new noPendaftaran();
            $no_urut->tahun = date('Y');
            $no_urut->nomor = '2';
            $no_urut->save();
        }
        return $no_pendaftaran;
    }

    private function statusSaatMendaftarTranslator($data)
    {
        if($data->lulus_sma){return "lulus_sma";}
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
}
