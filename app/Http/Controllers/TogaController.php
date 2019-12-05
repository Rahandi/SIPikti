<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mahasiswa;
use App\mahasiswaJadwal;
use App\jadwal;
use App\masterKelas;
use App\toga;
use App\config;

class TogaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $config = config::where('name', 'harga toga')->first();

        $harga = new \stdClass();
        $harga->string = strrev(explode('|', $config->data)[0]);
        $harga->string = str_split($harga->string, "3");
        $harga->string = implode('.', $harga->string);
        $harga->string = strrev($harga->string);

        $harga->number = explode('|', $config->data)[0];
        $harga->terbilang = explode('|', $config->data)[1];

        $data = mahasiswa::all();
        foreach ($data as $m) {
            $mahasiswajadwal = mahasiswaJadwal::where('mahasiswa_id', $m->id)->first();
            if($mahasiswajadwal)
            {
                $m->jadwal = $mahasiswajadwal;
                $jadwal = jadwal::find($mahasiswajadwal->jadwal_id);
                $m->kelas = masterKelas::find($jadwal->id_kelas)->nama;
            }
            else
            {
                $m->jadwal = NULL;
                $m->kelas = NULL;
            }
        }
        return view('keuangan.toga.index', ['data' => $data, 'harga' => $harga]);
    }

    public function kwitansi($id)
    {
        $config = config::where('name', 'harga toga')->first();
        $harga = strrev(explode('|', $config->data)[0]);
        $harga = str_split($harga, "3");
        $harga = implode('.', $harga);
        $harga = strrev($harga);
        $terbilang = explode('|', $config->data)[1];

        $toga = toga::where('mahasiswa_id', $id)->first();
        if(!$toga)
        {
            $mahasiswa = mahasiswa::find($id);
            $mahasiswaJadwal = mahasiswaJadwal::where('mahasiswa_id', $id)->first();
            $jadwal = jadwal::find($mahasiswaJadwal->jadwal_id);
            $kelas = masterKelas::find($jadwal->id_kelas);

            $nomor = toga::select('nomor')->orderBy('id', 'desc')->first();
            if(!$nomor)
            {
                $nomor = '00-00';
            }
            else
            {
                $nomor = $nomor->nomor;
            }
            $nomor = explode('-', $nomor);
            $nomor[1] = (int)$nomor[1];
            $tahun = date('y');
            if($tahun != $nomor[0])
            {
                $nomor = [$tahun, 0];
            }
            $nomor[1] = $nomor[1] + 1;
            $nomor[1] = str_pad($nomor[1], 3, '0', STR_PAD_LEFT);

            $toga = new toga();
            $toga->mahasiswa_id = $mahasiswa->id;
            $toga->nama = $mahasiswa->nama;
            $toga->nrp = $mahasiswa->nrp;
            $toga->kelas = $kelas->nama;
            $toga->nomor = implode('-', $nomor);

            $toga->save();
        }

        $data = new \stdClass();
        $data->mahasiswa = $toga->nama;
        $data->nrp = $toga->nrp;
        $data->kelas = $toga->kelas;
        $data->nomor = $toga->nomor;
        $data->date = $this->get_date();
        $data->harga = $harga;
        $data->terbilang = $terbilang;
        return view ('keuangan.toga.kwitansi', compact('data'));
    }

    public function update_harga_toga(Request $request)
    {
        $config = config::where('name', 'harga toga')->first();
        $config->data = [$request->number, $request->terbilang];
        $config->data = implode('|', $config->data);
        $config->save();

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
