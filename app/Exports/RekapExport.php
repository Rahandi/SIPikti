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
        for($i=0;$i<count($data);$i++){
            $data[$i]->data_pembayaran = unserialize($data[$i]->data_pembayaran);
            // disintegrate pembayaran
            $data_pembayaran = array(
                "Daftar ulang 1" => $data[$i]->data_pembayaran['Daftar ulang 1']['tanda'],
                "Daftar ulang 2" => $data[$i]->data_pembayaran['Daftar ulang 2']['tanda']
            );
            for($j=1;$j<=5;$j++){
                $angsuran = "Angsuran ".$j;
                $data_pembayaran[$angsuran] = isset($data[$i]->data_pembayaran[$angsuran]) ? $data[$i]->data_pembayaran[$angsuran]['tanda'] : -1;
            }
            $data[$i]->data_pembayaran = $data_pembayaran;
        }
        
    }
}
