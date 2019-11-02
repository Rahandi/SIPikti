<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    protected $table = 'nilai';

    public static function findOrCreate($id_master_nilai, $id_mahasiswa)
    {
        $obj = static::where('id_master_nilai', $id_master_nilai)
                        ->where('id_mahasiswa', $id_mahasiswa)
                        ->get()
                        ->first();
        return $obj ?: new static;
    }
}
