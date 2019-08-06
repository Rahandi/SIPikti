<?php

namespace App\Http\Controllers;

use App\pendaftar;
use App\pendidikan;
use App\statusSaatMendaftar;
use App\alamat;
use App\sumberInformasi;
use App\noPendaftaran;
use App\mahasiswa;
use App\angsuran;
use App\mahasiswaangsuran;
use App\jadwal;
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

    public function statistic()
    {
        $data = array();
        //angsuran
        $data['angsuran'] = array();
        $angsuran = angsuran::all();
        foreach($angsuran as $element)
        {
            $aggregate = \DB::table('mahasiswa_angsuran')
                            ->select('*')
                            ->where('angsuran_id', '=', $element->id)
                            ->get();
            $data['angsuran'][$element->nama] = count($aggregate);
        }

        //kelas
        $data['kelas'] = array();
        $jadwal = jadwal::all();
        foreach($jadwal as $element)
        {
            $aggregate = \DB::table('mahasiswa_jadwal')
                            ->select('*')
                            ->where('jadwal_id', '=', $element->id)
                            ->get();
            $data['kelas'][$element->kelasA] = count($aggregate);
        }

        return view('dashboard.index', compact('data'));
    }

    public function index()
    {
        $data = pendaftar::all();
        return view('pendaftaran.index', compact('data'));
    }

    public function detail2($id)
    {
        $data = $this->getPendaftarFullDetails($id);
        return view('pendaftaran.detail', compact('data'));
    }

    public function list()
    {
        $data = pendaftar::all();
        return view('list', compact('data'));
    }

    public function kwitansi($id)
    {
        $date = $this->get_date();
        $pendaftar = pendaftar::find($id);
        $pendaftar->administrator = Auth::user()->name;
        $data = array(
            'pendaftar' => $pendaftar,
            'date' => $date
        );
        return view('pendaftaran.kwitansi', compact('data'));
    }

    public function detail($id)
    {
        $data = $this->getPendaftarFullDetails($id);
        return view('pendaftaran.detail', compact('data'));
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
        $data['sumber_informasi'] = $data_sumber_informasi;
        return view('pendaftaran.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data_utama = pendaftar::find($id);
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
        return redirect()->route('detail', ['id' => $data->id]);
    }

    public function verifikasi(Request $request)
    {
        $id = $request->id;
        $pendaftar = pendaftar::find($id);
        if($pendaftar->nomor_pendaftaran === null){
            $pendaftar->nomor_pendaftaran = $this->generateNoPendaftaran();
            $pendaftar->tanggal_verifikasi = $this->get_date();
            $pendaftar->administrator = Auth::user()->name;
            $pendaftar->save();
            return redirect()->back();
        }
        return redirect()->back()->withErrors(['Sudah terverifikasi']);
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

        return redirect()->route('pendaftaran');
    }

    public function acceptToMahasiswa(Request $request)
    {
        $id = $request->id;
        $data = pendaftar::find($id);
        $data->status = 1;
        $data->save();
        $mahasiswa = new mahasiswa();
        $mahasiswa->nomor_pendaftaran = $data->nomor_pendaftaran;
        $mahasiswa->nama = $data->nama;
        $mahasiswa->nama_gelar = $data->nama_gelar;
        $mahasiswa->tempat_lahir = $data->tempat_lahir;
        $mahasiswa->tanggal_lahir = $data->tanggal_lahir;
        $mahasiswa->jenis_kelamin = $data->jenis_kelamin;
        $mahasiswa->agama = $data->agama;
        $mahasiswa->status_perkawinan = $data->status_perkawinan;
        $mahasiswa->nomor_handphone = $data->nomor_handphone;
        $mahasiswa->pendidikan_id = $data->pendidikan_id;
        $mahasiswa->alamat_asal_id = $data->alamat_asal_id;
        $mahasiswa->alamat_surabaya_id = $data->alamat_surabaya_id;
        $mahasiswa->status_saat_mendaftar_id = $data->status_saat_mendaftar_id;
        $mahasiswa->sumber_informasi_id = $data->sumber_informasi_id;
        $mahasiswa->administrator = $data->administrator;
        $mahasiswa->save();
        return redirect()->back();
    }

    private function generateNoPendaftaran()
    {
        $current_year = date('Y');
        $current_year = substr($current_year, 2, strlen($current_year));
        $tahun_angkatan = date('Y', strtotime('+5 year'));
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
        if($data->lulus_sma){return "Lulus SMA";}
        if($data->mahasiswa){return "Mahasiswa";}
        if($data->bekerja){return "Bekerja";}
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

    private static function findOrCreate($exist, $new)
    {
        return ($exist ? $exist : $new);
    }

    private function get(&$var, $default=-1) {
    	return isset($var) ? $var : $default;
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