<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = DB::table('transaksi')
            ->join('anggota', 'transaksi.anggota_id', '=', 'anggota.id')
            ->join('buku', 'transaksi.buku_id', '=', 'buku.id')
            ->select('transaksi.*', 'anggota.nama', 'buku.judul')
            ->orderBy('transaksi.id', 'desc')
            ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $anggota = DB::table('anggota')->get();
        $buku = DB::table('buku')->get();

        return view('transaksi.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        // VALIDASI STOK (penting)
        $buku = DB::table('buku')->where('id', $request->buku_id)->first();

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        DB::transaction(function () use ($request) {

            DB::table('transaksi')->insert([
                'anggota_id' => $request->anggota_id,
                'buku_id' => $request->buku_id,
                'user_id' => session('user_id'),
                'tanggal_pinjam' => now(),
                'status' => 'pinjam'
            ]);

            DB::table('buku')
                ->where('id', $request->buku_id)
                ->decrement('stok');
        });

        return redirect('/transaksi');
    }

    public function kembali($id)
    {
        DB::transaction(function () use ($id) {

            $trx = DB::table('transaksi')->where('id', $id)->first();

            DB::table('transaksi')
                ->where('id', $id)
                ->update([
                    'status' => 'kembali',
                    'tanggal_kembali' => now()
                ]);

            DB::table('buku')
                ->where('id', $trx->buku_id)
                ->increment('stok');
        });

        return redirect('/transaksi');
    }
}