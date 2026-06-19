<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Anggota
{
    public static function getAll()
    {
        return DB::table('anggota')->orderBy('id', 'desc')->get();
    }

    public static function findById($id)
    {
        return DB::table('anggota')->where('id', $id)->first();
    }

    public static function simpan($data)
    {
        return DB::table('anggota')->insert($data);
    }

    public static function ubah($id, $data)
    {
        return DB::table('anggota')->where('id', $id)->update($data);
    }

    public static function hapus($id)
    {
        return DB::table('anggota')->where('id', $id)->delete();
    }
}
