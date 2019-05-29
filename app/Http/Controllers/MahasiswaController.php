<?php

namespace App\Http\Controllers;

use App\pendaftar;
use App\mahasiswa;
use App\angsuran;
use App\mahasiswaAngsuran;
use App\alamat;
use App\statusSaatMendaftar;
use App\sumberInformasi;
use App\pendidikan;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = mahasiswa::all();
        return view('mahasiswa', compact('data'));
    }

    public function detail(Request $request)
    {
        $data = $this->getPendaftarFullDetails($request->id);
        return view('detail_mahasiswa', compact('data'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data_utama = mahasiswa::find($id);
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
        $data['sumber_informasi'] = $data_sumber_informasi;
        return view('edit_mahasiswa', compact('data'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data_utama = mahasiswa::find($id);
        $data_alamat_asal = alamat::find($data_utama->alamat_asal_id);
        $data_alamat_surabaya = alamat::find($data_utama->alamat_surabaya_id);
        $data_status_saat_mendaftar = statusSaatMendaftar::find($data_utama->status_saat_mendaftar_id);
        $data_sumber_informasi = sumberInformasi::find($data_utama->sumber_informasi_id);
        $pendidikan_id = unserialize($data_utama->pendidikan_id);

        //bagian status saat mendaftar
        $data_status_saat_mendaftar->lulus_sma = ($request->status == 'lulus_sma') ? 1 : 0;
        $data_status_saat_mendaftar->mahasiswa = ($request->status == 'mahasiswa') ? 1 : 0;
        $data_status_saat_mendaftar->bekerja = ($request->status == 'bekerja') ? 1 : 0;
        $data_status_saat_mendaftar->save();

        //bagian sumber informasi
        $data_sumber_informasi->koran = (isset($request->koran)) ? 1 : 0;
        $data_sumber_informasi->spanduk = (isset($request->spanduk)) ? 1 : 0;
        $data_sumber_informasi->brosur = (isset($request->brosur)) ? 1 : 0;
        $data_sumber_informasi->teman_saudara = (isset($request->teman_saudara)) ? 1 : 0;
        $data_sumber_informasi->pameran = (isset($request->pameran)) ? 1 : 0;
        $data_sumber_informasi->lainnya = (isset($request->lainnya)) ? 1 : 0;
        $data_sumber_informasi->save();

        //bagian data pribadi
        $data_utama->nama = $request->nama;
        $data_utama->nama_gelar = $request->nama_gelar;
        $data_utama->tempat_lahir = $request->tempat_lahir;
        $data_utama->tanggal_lahir = $request->tanggal_lahir;
        $data_utama->jenis_kelamin = $request->jenis_kelamin;
        $data_utama->agama = $request->agama;
        $data_utama->status_perkawinan = $request->status_perkawinan;
        $data_utama->nomor_handphone = $request->nomor_handphone;

        //bagian alamat
        ///alamat asal
        $data_alamat_asal->jalan = $request->asal_jalan;
        $data_alamat_asal->kelurahan = $request->asal_kelurahan;
        $data_alamat_asal->kecamatan = $request->asal_kecamatan;
        $data_alamat_asal->kabupaten = $request->asal_kabupaten;
        $data_alamat_asal->kode_pos = $request->asal_kode_pos;
        $data_alamat_asal->telepon = $request->asal_telepon;
        $data_alamat_asal->save();
        ///alamat surabaya
        $data_alamat_surabaya->jalan = $request->surabaya_jalan;
        $data_alamat_surabaya->kelurahan = $request->surabaya_kelurahan;
        $data_alamat_surabaya->kecamatan = $request->surabaya_kecamatan;
        $data_alamat_surabaya->kabupaten = $request->surabaya_kabupaten;
        $data_alamat_surabaya->kode_pos = $request->surabaya_kode_pos;
        $data_alamat_surabaya->telepon = $request->surabaya_telepon;
        $data_alamat_surabaya->save();
        if (isset($request->sd_institusi, $request->sd_tahun_masuk, $request->sd_tahun_lulus)) {
            $table_pendidikan = $this->findOrCreate(pendidikan::find($pendidikan_id['sd']), new pendidikan);
            $table_pendidikan->jenjang_pendidikan = 'sd';
            $table_pendidikan->institusi = $request->sd_institusi;
            $table_pendidikan->tahun_masuk = $request->sd_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->sd_tahun_lulus;
            $table_pendidikan->save();
        }

        if (isset($request->sltp_institusi, $request->sltp_tahun_masuk, $request->sltp_tahun_lulus)) {
            $table_pendidikan = $this->findOrCreate(pendidikan::find($pendidikan_id['sltp']), new pendidikan);
            $table_pendidikan->jenjang_pendidikan = 'sltp';
            $table_pendidikan->institusi = $request->sltp_institusi;
            $table_pendidikan->tahun_masuk = $request->sltp_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->sltp_tahun_lulus;
            $table_pendidikan->save();
        }

        if (isset($request->slta_institusi, $request->slta_bidang_studi, $request->slta_tahun_masuk, $request->slta_tahun_lulus)) {
            $table_pendidikan = $this->findOrCreate(pendidikan::find($pendidikan_id['slta']), new pendidikan);
            $table_pendidikan->jenjang_pendidikan = 'slta';
            $table_pendidikan->institusi = $request->slta_institusi;
            $table_pendidikan->bidang_studi = $request->slta_bidang_studi;
            $table_pendidikan->tahun_masuk = $request->slta_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->slta_tahun_lulus;
            $table_pendidikan->save();
        }

        if (isset($request->diploma_institusi, $request->diploma_bidang_studi, $request->diploma_tahun_masuk, $request->diploma_tahun_lulus)) {
            $table_pendidikan = $this->findOrCreate(pendidikan::find($this->get($pendidikan_id['diploma'])), new pendidikan);
            $table_pendidikan->jenjang_pendidikan = 'diploma';
            $table_pendidikan->institusi = $request->diploma_institusi;
            $table_pendidikan->bidang_studi = $request->diploma_bidang_studi;
            $table_pendidikan->tahun_masuk = $request->diploma_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->diploma_tahun_lulus;
            $table_pendidikan->save();
            $pendidikan_id['diploma'] = $table_pendidikan->id;
        }
        else {
            if (isset($pendidikan_id['diploma'])) {
                $data = pendidikan::find($pendidikan_id['diploma']);
                $data->delete();
                unset($pendidikan_id['diploma']);
            }
        }

        if (isset($request->sarjana_institusi, $request->sarjana_bidang_studi, $request->sarjana_tahun_masuk, $request->sarjana_tahun_lulus)) {
            $table_pendidikan = $this->findOrCreate(pendidikan::find($this->get($pendidikan_id['sarjana'])), new pendidikan);
            $table_pendidikan->jenjang_pendidikan = 'sarjana';
            $table_pendidikan->institusi = $request->sarjana_institusi;
            $table_pendidikan->bidang_studi = $request->sarjana_bidang_studi;
            $table_pendidikan->tahun_masuk = $request->sarjana_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->sarjana_tahun_lulus;
            $table_pendidikan->save();
            $pendidikan_id['sarjana'] = $table_pendidikan->id;
        }
        else {
            if (isset($pendidikan_id['sarjana'])) {
                $data = pendidikan::find($pendidikan_id['sarjana']);
                $data->delete();
                unset($pendidikan_id['sarjana']);
            }
        }

        if (isset($request->lainnya_institusi, $request->lainnya_bidang_studi, $request->lainnya_tahun_masuk, $request->lainnya_tahun_lulus)) {
            $table_pendidikan = $this->findOrCreate(pendidikan::find($this->get($pendidikan_id['lainnya'])), new pendidikan);
            $table_pendidikan->jenjang_pendidikan = 'lainnya';
            $table_pendidikan->institusi = $request->lainnya_institusi;
            $table_pendidikan->bidang_studi = $request->lainnya_bidang_studi;
            $table_pendidikan->tahun_masuk = $request->lainnya_tahun_masuk;
            $table_pendidikan->tahun_lulus = $request->lainnya_tahun_lulus;
            $table_pendidikan->save();
            $pendidikan_id['lainnya'] = $table_pendidikan->id;
        }else {
            if (isset($pendidikan_id['lainnya'])) {
                $data = pendidikan::find($pendidikan_id['lainnya']);
                $data->delete();
                unset($pendidikan_id['lainnya']);
            }
        }

        $data_utama->pendidikan_id = serialize($pendidikan_id);

        $data_utama->save();
        $data = $this->getPendaftarFullDetails($data_utama->id);
        return redirect()->route('mahasiswa.detail', ['id' => $data->id]);
    }

    public function delete(Request $request)
    {
        $mahasiswa = mahasiswa::find($request->id);
        $pendaftar = pendaftar::where('nomor_pendaftaran', $mahasiswa->nomor_pendaftaran)->get()->first();
        $pendaftar->status = 0;
        $pendaftar->save();
        $mahasiswa->delete();
        return redirect()->back();
    }

    private static function findOrCreate($exist, $new)
    {
        return ($exist ? $exist : $new);
    }

    private function statusSaatMendaftarTranslator($data)
    {
        if($data->lulus_sma){return "Lulus SMA";}
        if($data->mahasiswa){return "Mahasiswa";}
        if($data->bekerja){return "Bekerja";}
    }

    private function getPendaftarFullDetails($id) {
        $data_utama = mahasiswa::find($id);
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

    private function sumberInformasiTranslator($data)
    {
        $sumber_informasi = array();
        if($data->koran){array_push($sumber_informasi, "Koran");}
        if($data->spanduk){array_push($sumber_informasi, "Spanduk");}
        if($data->brosur){array_push($sumber_informasi, "Brosur");}
        if($data->teman_saudara){array_push($sumber_informasi, "Teman / Saudara");}
        if($data->pameran){array_push($sumber_informasi, "Pameran");}
        if($data->lainnya){array_push($sumber_informasi, "Lainnya");}
        $sumber_informasi = join(', ', $sumber_informasi);
        return $sumber_informasi;
    }

    private function get(&$var, $default=-1) {
        return isset($var) ? $var : $default;
    }
}
