<?php

namespace App\Exports;

use App\jadwal;
use App\mahasiswa;
use App\masterNilai;
use App\masterKelas;
use App\masterMK;
use App\masterDosen;
use App\masterAsisten;
use App\mahasiswaJadwal;
use App\nilai;
use App\akhir_kompre;
use App\akhir_kp;
use App\akhir_pa;
use App\akhir_pakp;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PAKPExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct($jenis, $tahun)
    {
        if($jenis == 'pa')
        {
            $this->master = akhir_pa::where('tahun', $tahun);
        }
        elseif($jenis == 'kp')
        {
            $this->master = akhir_kp::where('tahun', $tahun);
        }
        elseif($jenis == 'pakp')
        {
            $this->master = akhir_pakp::where('tahun', $tahun);
        }
        elseif($jenis == 'kompre')
        {
            $this->master = akhir_kompre::where('tahun', $tahun);
        }

        $this->jenis = $jenis;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $data = [];
        for($i=0; $i<count($this->master); $i++)
        {
            $item = $this->master[$i];
            $mahasiswa = mahasiswa::find($item->mahasiswa_id);

            $temp = [];
            $temp['No.'] = $i + 1;
            $temp['NRP'] = $mahasiswa->nrp;
            $temp['Nama'] = $mahasiswa->nama;

            if($this->jenis == 'pa')
            {
                $temp['Judul'] = $item->judul;
                $temp['Pembimbing'] = $item->pembimbing;
                $temp['Nilai'] = $item->nilai;
            }
            elseif($this->jenis == 'kp')
            {
                $temp['Nilai'] = $item->nilai;
            }
            elseif($this->jenis == 'pakp')
            {
                $temp['Judul'] = $item->judul;
                $temp['Pembimbing'] = $item->pembimbing;
                $temp['Nilai PA'] = $item->nilai_pa;
                $temp['Nilai KP'] = $item->nilai_kp;
            }
            elseif($this->jenis == 'kompre')
            {
                $temp['Nilai'] = $item->nilai;
            }

            array_push($data, $temp);
        }

        return collect($data);
    }

    public function headings(): array
    {
        if($this->jenis == 'pa')
        {
            $head = ['No.', 'NRP', 'Nama', 'Judul', 'Pembimbing', 'Nilai'];
        }
        elseif($this->jenis == 'kp')
        {
            $head = ['No.', 'NRP', 'Nama', 'Nilai'];
        }
        elseif($this->jenis == 'pakp')
        {
            $head = ['No.', 'NRP', 'Nama', 'Judul', 'Pembimbing', 'Nilai PA', 'Nilai KP'];
        }
        elseif($this->jenis == 'kompre')
        {
            $head = ['No.', 'NRP', 'Nama', 'Nilai'];
        }

        return $head;
    }
}
