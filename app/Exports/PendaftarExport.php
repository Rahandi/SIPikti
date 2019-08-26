<?php

namespace App\Exports;

use App\pendaftar;
use App\alamat;
use App\statusSaatMendaftar;
use App\sumberInformasi;
use App\pendidikan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendaftarExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $data = pendaftar::all();
        $data_array = array();
        for($i=0;$i<count($data);$i++)
        {
            $pendidikan_id = unserialize($data[$i]->pendidikan_id);
            $data_alamat_asal = alamat::find($data[$i]->alamat_asal_id);
            $data_alamat_surabaya = alamat::find($data[$i]->alamat_surabaya_id);
            $data_status_saat_mendaftar = statusSaatMendaftar::find($data[$i]->status_saat_mendaftar_id);
            $data_sumber_informasi = sumberInformasi::find($data[$i]->sumber_informasi_id);

            foreach($pendidikan_id as $key => $value)
            {
                $data_pendidikan[$key] = pendidikan::find($value);
            }

            $alamat_asal = $data_alamat_asal->jalan . ', ' . $data_alamat_asal->kelurahan . ', ' . $data_alamat_asal->kecamatan . ', ' . $data_alamat_asal->kabupaten . ', ' . $data_alamat_asal->kode_pos;
            $alamat_surabaya = $data_alamat_surabaya->jalan . ', ' . $data_alamat_surabaya->kelurahan . ', ' . $data_alamat_surabaya->kecamatan . ', ' . $data_alamat_surabaya->kabupaten . ', ' . $data_alamat_surabaya->kode_pos;

            $temp = array(
                "Nomor Pendaftaran" => $data[$i]->nomor_pendaftaran,
                "Nama" => $data[$i]->nama,
                "Tempat Lahir" => $data[$i]->tempat_lahir,
                "Tanggal Lahir" => $data[$i]->tanggal_lahir,
                "Jenis Kelamin" => $data[$i]->jenis_kelamin,
                "Agama" => $data[$i]->agama,
                "Status Perkawinan" => $data[$i]->status_perkawinan,
                "Nomor Handphone" => $data[$i]->nomor_handphone,
                "Alamat Asal" => $alamat_asal,
                "Alamat Surabaya" => $alamat_surabaya,
                "SD" => $data_pendidikan['sd']->institusi,
                "SMP" => $data_pendidikan['sltp']->institusi,
                "SMU" => $data_pendidikan['slta']->institusi,
                "Status" => $this->statusSaatMendaftarTranslator($data_status_saat_mendaftar),
                "Sumber Informasi" => $this->sumberInformasiTranslator($data_sumber_informasi)
            );

            array_push($data_array, $temp);
        }

        return collect($data_array);
    }

    public function headings(): array
    {
        return [
            "Nomor Pendaftaran",
            "Nama",
            "Tempat Lahir",
            "Tanggal Lahir",
            "Jenis Kelamin",
            "Agama",
            "Status Perkawinan",
            "Nomor Handphone",
            "Alamat Asal",
            "Alamat Surabaya",
            "SD",
            "SMP",
            "SMU",
            "Status",
            "Sumber Informasi"
        ];
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
}
