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
        //
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
        //dd($request);
        $data_pendidikan = array();

        //bagian data pribadi
        $table_daftar = new pendaftar();
        $table_daftar->administrator = null;
        $table_daftar->nomor_pendaftaran = null;
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
            $table_pendidikan->bidang_studi = '-';
            $table_pendidikan->tahun_masuk = $request->sd_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->sd_tahun_lulus;
            $table_pendidikan->save();
            $data_pendidikan['sd'] = $table_pendidikan->id;
        }
        
        if (isset($request->sltp_institusi, $request->sltp_bidang_studi, $request->sltp_tahun_masuk, $request->sltp_tahun_lulus)) {
            $table_pendidikan = new pendidikan();
            $table_pendidikan->jenjang_pendidikan = 'sltp';
            $table_pendidikan->institusi = $request->sltp_institusi;
            $table_pendidikan->bidang_studi = '-';
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
        $table_status_saat_mendaftar->lulus_sma = ($request->status == 'lulus_sma') ? 1 : 0;
        $table_status_saat_mendaftar->mahasiswa = ($request->status == 'mahasiswa') ? 1 : 0;
        $table_status_saat_mendaftar->bekerja = ($request->status == 'bekerja') ? 1 : 0;
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
        return redirect('/')->with('status','Pendaftaran Sukses');
    }
}
