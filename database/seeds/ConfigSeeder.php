<?php

use Illuminate\Database\Seeder;

use App\config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        config::create([
            'name' => 'harga toga',
            'data' => '300000|Tiga Ratus Ribu Rupiah'
        ]);

        config::create([
            'name' => 'pejabat 1',
            'data' => 'Kepala UPT Pusat Pelatihan dan Sertifikasi Profesi|Arya Yudhi Wijaya, S.Kom., M. Kom.|19840904 201012 1 002'
        ]);

        config::create([
            'name' => 'pejabat 2',
            'data' => 'Ketua PIKTI ITS|Abdul Munif, S.Kom., M.Sc.|19860823 201504 1 004'
        ]);
    }
}
