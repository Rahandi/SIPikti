<?php

namespace App\Exports;

use App\angsuran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $data = \DB::table('mahasiswa_angsuran')
        ->join('mahasiswa', 'mahasiswa_angsuran.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('angsuran', 'mahasiswa_angsuran.angsuran_id', '=', 'angsuran.id')
        ->select('mahasiswa.nrp', 'mahasiswa.nama', 'angsuran.nama as angsuran_nama', 'mahasiswa_angsuran.data_pembayaran')
        ->get();
        $data_array = array();
        for($i=0;$i<count($data);$i++){
            $data[$i]->data_pembayaran = unserialize($data[$i]->data_pembayaran);
            // disintegrate pembayaran
            $temp_data = array(
                "nrp" => $data[$i]->nrp,
                "nama" => $data[$i]->nama,
                "angsuran_nama" => $data[$i]->angsuran_nama
            );
            array_push($data_array, $temp_data);
            $data_array[$i]["Daftar ulang 1"] = ($data[$i]->data_pembayaran['Daftar ulang 1']['tanda'] == 1) ? "sudah bayar" : "belum bayar";
            $data_array[$i]["Daftar ulang 2"] = ($data[$i]->data_pembayaran['Daftar ulang 2']['tanda'] == 1) ? "sudah bayar" : "belum bayar";
            for($j=1;$j<=5;$j++){
                $angsuran = "Angsuran ".$j;
                $data_array[$i][$angsuran] = isset($data[$i]->data_pembayaran[$angsuran]) ? $data[$i]->data_pembayaran[$angsuran]['tanda'] : -1;
                $data_array[$i][$angsuran] = ($data_array[$i][$angsuran] == 1) ? "sudah bayar" : $data_array[$i][$angsuran];
                $data_array[$i][$angsuran] = ($data_array[$i][$angsuran] == 0) ? "belum bayar" : $data_array[$i][$angsuran];
                $data_array[$i][$angsuran] = ($data_array[$i][$angsuran] == -1) ? "-" : $data_array[$i][$angsuran];
            }
        }

        return collect($data_array);
    }

    public function headings(): array
    {
        return [
            "nrp",
            "nama",
            "angsuran_nama",
            "Daftar ulang 1",
            "Daftar ulang 2",
            "Angsuran 1",
            "Angsuran 2",
            "Angsuran 3",
            "Angsuran 4",
            "Angsuran 5",
        ];
    }
}
