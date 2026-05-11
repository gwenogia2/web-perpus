<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    //LIST TRANSAKSI
    public function index()
    {
        $transaksi = DB::table('transaksi')
            ->join('anggota', 'transaksi.anggota_id', '=', 'anggota.id')
            ->join('detail_transaksi', 'transaksi.id', '=', 'detail_transaksi.transaksi_id')
            ->join('buku', 'detail_transaksi.buku_id', '=', 'buku.id')
            ->select(
                'transaksi.id',
                'anggota.nama',
                'transaksi.tanggal_pinjam',
                'transaksi.tanggal_kembali',
                'transaksi.status',
                DB::raw("string_agg(buku.judul, ', ') as buku")
            )
            ->groupBy(
                'transaksi.id',
                'anggota.nama',
                'transaksi.tanggal_pinjam',
                'transaksi.tanggal_kembali',
                'transaksi.status'
            )
            ->orderBy('transaksi.id', 'desc')
            ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    // FORM CREATE
    public function create()
    {
        $anggota = DB::table('anggota')->get();
        $buku = DB::table('buku')->get();

        return view('transaksi.create', compact('anggota', 'buku'));
    }

    //SIMPAN TRANSAKSI (MULTI BUKU)
    public function store(Request $request)
{
    if (!$request->buku_id) {
        return back()->with('error', 'Pilih minimal 1 buku!');
    }

    DB::transaction(function () use ($request) {

        $transaksi_id = DB::table('transaksi')->insertGetId([
            'anggota_id' => $request->anggota_id,
            'user_id' => session('user_id'),
            'tanggal_pinjam' => now(),
            'status' => 'pinjam'
        ]);

        foreach ($request->buku_id as $buku_id) {

            $qty = $request->jumlah[$buku_id] ?? 1;

            $buku = DB::table('buku')->where('id', $buku_id)->first();

            // VALIDASI STOK
            if ($buku->stok < $qty) {
                throw new \Exception("Stok buku '{$buku->judul}' tidak cukup!");
            }

            // insert detail
            DB::table('detail_transaksi')->insert([
                'transaksi_id' => $transaksi_id,
                'buku_id' => $buku_id,
                'jumlah' => $qty
            ]);

            // kurangi stok sesuai qty
            DB::table('buku')
                ->where('id', $buku_id)
                ->decrement('stok', $qty);
        }

    });

    return redirect('/pinjam')
            ->with('success', 'Berhasil.');
}
    //KEMBALIKAN SEMUA BUKU
    public function kembali($id)
    {
        DB::transaction(function () use ($id) {

            // ambil semua detail
            $details = DB::table('detail_transaksi')
                ->where('transaksi_id', $id)
                ->get();

            // kembalikan stok semua buku
            foreach ($details as $d) {
                DB::table('buku')
                    ->where('id', $d->buku_id)
                    ->increment('stok');
            }

            // update status transaksi
            DB::table('transaksi')
                ->where('id', $id)
                ->update([
                    'status' => 'kembali',
                    'tanggal_kembali' => now()
                ]);
        });

        return redirect('/transaksi');
    }

    public function detail($id)
{
    $transaksi = DB::table('transaksi')
        ->join('anggota', 'transaksi.anggota_id', '=', 'anggota.id')
        ->select('transaksi.*', 'anggota.nama')
        ->where('transaksi.id', $id)
        ->first();

    $detail = DB::table('detail_transaksi')
        ->join('buku', 'detail_transaksi.buku_id', '=', 'buku.id')
        ->select('buku.judul', 'detail_transaksi.jumlah')
        ->where('detail_transaksi.transaksi_id', $id)
        ->get();

    return view('transaksi.detail', compact('transaksi', 'detail'));
}

public function pinjam()
{
    $anggota = DB::table('anggota')->get();

    $buku = DB::table('buku')
        ->where('stok', '>', 0)
        ->get();

    return view('siswa.pinjam', compact(
        'anggota',
        'buku'
    ));
}
}