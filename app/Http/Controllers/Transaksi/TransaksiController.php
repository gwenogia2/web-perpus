<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['anggota', 'buku'])
            ->latest('id')
            ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        $buku = Buku::all();

        return view('transaksi.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        DB::transaction(function () use ($request, $buku) {
            Transaksi::create([
                'anggota_id' => $request->anggota_id,
                'buku_id' => $request->buku_id,
                'user_id' => session('user_id'),
                'tanggal_pinjam' => now(),
                'status' => 'pinjam'
            ]);

            $buku->decrement('stok');
    });

        return redirect('/transaksi');
    }

    public function kembali($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        DB::transaction(function () use ($transaksi) {
            $transaksi->update([
                'status' => 'kembali',
                'tanggal_kembali' => now()
            ]);

            $transaksi->buku->increment('stok');
        });

        return redirect('/transaksi');
    }
}
