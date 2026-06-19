<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Transaksi
{
    public static function getAllWithRelations()
    {
        return DB::table('transaksi')
            ->leftJoin('anggota', 'transaksi.anggota_id', '=', 'anggota.id')
            ->leftJoin('buku', 'transaksi.buku_id', '=', 'buku.id_buku')
            ->select(
                'transaksi.*',
                'anggota.nama as nama_anggota',
                'buku.judul as judul_buku'
            )
            ->orderBy('transaksi.id', 'desc')
            ->get();
    }

    public static function findById($id)
    {
        return DB::table('transaksi')->where('id', $id)->first();
    }

    public static function simpanPeminjaman($data, $bukuId)
    {
        return DB::transaction(function () use ($data, $bukuId) {
            DB::table('transaksi')->insert($data);

            DB::table('buku')
                ->where('id_buku', $bukuId)
                ->decrement('stok');
        });
    }

    public static function prosesPengembalian($transaksi)
    {
        return DB::transaction(function () use ($transaksi) {
            DB::table('transaksi')
                ->where('id', $transaksi->id)
                ->update([
                    'status' => 'kembali',
                    'tanggal_kembali' => now(),
                    'updated_at' => now()
                ]);

            DB::table('buku')
                ->where('id_buku', $transaksi->buku_id)
                ->increment('stok');
        });
    }

    public static function updateTransaksi($id, $requestData, $transaksiLama)
    {
        return DB::transaction(function () use ($id, $requestData, $transaksiLama) {
            $bukuId = $requestData['buku_id'];
            $statusBaru = $requestData['status'];
            $tanggal_kembali = $transaksiLama->tanggal_kembali;

            if ($statusBaru == 'kembali' && $transaksiLama->status == 'pinjam') {
                DB::table('buku')->where('id_buku', $bukuId)->increment('stok');
                $tanggal_kembali = now();
            }
            elseif ($statusBaru == 'pinjam' && $transaksiLama->status == 'kembali') {
                DB::table('buku')->where('id_buku', $bukuId)->decrement('stok');
                $tanggal_kembali = null;
            }

            DB::table('transaksi')
                ->where('id', $id)
                ->update([
                    'anggota_id' => $requestData['anggota_id'],
                    'buku_id' => $bukuId,
                    'status' => $statusBaru,
                    'tanggal_kembali' => $tanggal_kembali,
                    'updated_at' => now()
                ]);
        });
    }
}
