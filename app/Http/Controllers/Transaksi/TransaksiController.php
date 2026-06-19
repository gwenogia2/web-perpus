<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Buku;
use App\Models\Anggota;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['anggota', 'buku'])
            ->latest('id')
            ->get();

        dd($transaksi->toArray());

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


        (new Transaksi)->getConnection()->transaction(function () use ($request, $buku) {
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

    public function pinjam()
    {
        $buku = Buku::where('stok', '>', 0)->get();

        return view('transaksi.index', compact('buku'));
    }

    public function kembali($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // PERBAIKAN DI SINI
        (new Transaksi)->getConnection()->transaction(function () use ($transaksi) {
            $transaksi->update([
                'status' => 'kembali',
                'tanggal_kembali' => now()
            ]);

            $transaksi->buku->increment('stok');
        });

        return redirect('/transaksi');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $anggota = Anggota::all();
        $buku = Buku::all();

        return view('transaksi.edit', compact('transaksi', 'anggota', 'buku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'anggota_id' => 'required',
            'buku_id' => 'required',
            'status' => 'required'
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // PERBAIKAN DI SINI
        (new Transaksi)->getConnection()->transaction(function () use ($request, $transaksi) {
            if ($request->status == 'kembali' && $transaksi->status == 'pinjam') {
                $transaksi->buku->increment('stok');
                $transaksi->tanggal_kembali = now();
            }
            elseif ($request->status == 'pinjam' && $transaksi->status == 'kembali') {
                if ($transaksi->buku->stok <= 0) {
                    return back()->with('error', 'Gagal mengubah status. Stok buku ini sedang kosong!');
                }
                $transaksi->buku->decrement('stok');
                $transaksi->tanggal_kembali = null;
            }

            $transaksi->update([
                'anggota_id' => $request->anggota_id,
                'buku_id' => $request->buku_id,
                'status' => $request->status,
                'tanggal_kembali' => $transaksi->tanggal_kembali
            ]);
        });

        return redirect('/transaksi')->with('sukses', 'Data transaksi berhasil diperbarui!');
    }
}
