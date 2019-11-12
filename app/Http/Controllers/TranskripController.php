<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\mahasiswa;
use App\nilai;
use App\masterNilai;
use App\masterMK;

class TranskripController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = mahasiswa::all();
        return view('akademik.transkrip.index', compac('data'));
    }

    public function download(Request $request)
    {
        $mahasiswa = mahasiswa::find($request->id);
        $nilais = nilai::where('id_mahasiswa', $request->id)->get();

        $return_nilai = new \stdClass();
        $return_nilai->nama = $mahasiswa->nama;
        $return_nilai->nrp = $mahasiswa->nrp;
        $return_nilai->ttl = $mahasiswa->tempat_lahir . ', ' . $this->parse_date($mahasiswa->tanggal_lahir);
        $return_nilai->nilai = array();
        $total = 0;
        $hitung = 0;
        foreach ($nilais as $nilai) {
            $id_master_nilai = $nilai->id_master_nilai;
            $master_nilai = masterNilai::find($id_master_nilai);
            $master_mk = masterMK::find($master_nilai->id_mk);
            $temp = new \stdClass();
            $temp->nama = $master_mk->nama;
            $temp->semester = $master_nilai->termin;
            $temp->sks = $master_mk->sks;
            $temp->nilai = ($nilai->nilai_total / 100.0) * 4;
            array_push($return_nilai->nilai, $temp);
            $total += $temp->nilai;
            $hitung += 1;
        }
    }

    private function parse_date($date){
        $dates = explode('-', $date);

        if($dates[1] == '01'){
            $dates[1] = 'Januari';
        }
        else if($dates[1] == '02'){
            $dates[1] = 'Februari';
        }
        else if($dates[1] == '03'){
            $dates[1] = 'Maret';
        }
        else if($dates[1] == '04'){
            $dates[1] = 'April';
        }
        else if($dates[1] == '05'){
            $dates[1] = 'Mei';
        }
        else if($dates[1] == '06'){
            $dates[1] = 'Juni';
        }
        else if($dates[1] == '07'){
            $dates[1] = 'Juli';
        }
        else if($dates[1] == '08'){
            $dates[1] = 'Agustus';
        }
        else if($dates[1] == '09'){
            $dates[1] = 'September';
        }
        else if($dates[1] == '10'){
            $dates[1] = 'Oktober';
        }
        else if($dates[1] == '11'){
            $dates[1] = 'November';
        }
        else if($dates[1] == '12'){
            $dates[1] = 'Desember';
        }

        $parsed = $dates[2] . ' ' . $dates[1] . ' ' . $dates[0];
        
        return $parsed;
    }
}
