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

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct($id_master_nilai)
    {
        $this->master_nilai = masterNilai::find($id_master_nilai);
    }

    public function collection()
    {
        $nama_penilaian = explode(',', $this->master_nilai->nama_penilaian);
        $persen_penilaian = explode(',', $this->master_nilai->persen_penilaian);
        $rows = mahasiswaJadwal::where('jadwal_id', $this->master_nilai->id_jadwal)->get();
        $data = array();
        for ($i=0; $i < count($rows); $i++)
        {
            $individu = mahasiswa::find($rows[$i]->mahasiswa_id);
            $temp = array();
            $temp['No.'] = $i + 1;
            $temp['NRP'] = $individu->nrp;
            $temp['Nama'] = $individu->nama;

            $nilai = nilai::where('id_mahasiswa', $rows[$i]->mahasiswa_id)->where('id_master_nilai', $this->master_nilai->id)->get()->first();
            if($nilai)
            {
                $nilai_detail = explode(',', $nilai->nilai);
                for ($j=0; $j < count($nama_penilaian); $j++) {
                    $temp[$nama_penilaian[$j] . ' (' . $persen_penilaian[$j] . '%)'] = $nilai_detail[$j];
                }
            }
            else
            {
                for ($j=0; $j < count($nama_penilaian); $j++) {
                    $temp[$nama_penilaian[$j] . ' (' . $persen_penilaian[$j] . '%)'] = '';
                }
            }

            array_push($data, $temp);
        }

        return collect($data);
    }

    public function headings(): array
    {
        $head = ['No.', 'NRP', 'Nama'];
        $nama_penilaian = explode(',', $this->master_nilai->nama_penilaian);
        $persen_penilaian = explode(',', $this->master_nilai->persen_penilaian);
        for ($i=0; $i < count($nama_penilaian); $i++) { 
            array_push($head, $nama_penilaian[$i] . ' (' . $persen_penilaian[$i] . '%)');
        }
        return $head;
    }
}
