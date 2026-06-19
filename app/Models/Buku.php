<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Buku
{
    public static function getAll()
    {
        return DB::table('buku')->orderBy('id_buku', 'desc')->get();
    }

    public static function findById($id)
    {
        return DB::table('buku')->where('id_buku', $id)->first();
    }

    public static function simpan($data)
    {
        return DB::table('buku')->insert($data);
    }

    public static function ubah($id, $data)
    {
        return DB::table('buku')->where('id_buku', $id)->update($data);
    }

    public static function hapus($id)
    {
        return DB::table('buku')->where('id_buku', $id)->delete();
    }
}
