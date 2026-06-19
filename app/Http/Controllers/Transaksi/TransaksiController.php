<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::getAllWithRelations();

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
        $buku = DB::table('buku')->where('id_buku', $request->buku_id)->first();

        if (!$buku || $buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis atau tidak ditemukan!');
        }

        $data = [
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'user_id' => session('user_id') ?? 1,
            'tanggal_pinjam' => now(),
            'status' => 'pinjam',
            'created_at' => now(),
            'updated_at' => now()
        ];

        Transaksi::simpanPeminjaman($data, $request->buku_id);

        return redirect('/pinjam')->with('sukses', 'Berhasil meminjam buku!');
    }

    public function pinjam()
    {
        $anggota = DB::table('anggota')->get();
        $buku = DB::table('buku')->where('stok', '>', 0)->get();

        return view('transaksi.create', compact('anggota', 'buku'));
    }

    public function kembali($id)
    {
        $transaksi = Transaksi::findById($id);

        if ($transaksi) {
            Transaksi::prosesPengembalian($transaksi);
        }

        return redirect('/transaksi')->with('sukses', 'Buku berhasil dikembalikan!');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findById($id);
        $anggota = DB::table('anggota')->get();
        $buku = DB::table('buku')->get();

        return view('transaksi.edit', compact('transaksi', 'anggota', 'buku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'anggota_id' => 'required',
            'buku_id' => 'required',
            'status' => 'required'
        ]);

        $transaksiLama = Transaksi::findById($id);
        $buku = DB::table('buku')->where('id_buku', $request->buku_id)->first();

        if ($request->status == 'pinjam' && $transaksiLama->status == 'kembali' && (!$buku || $buku->stok <= 0)) {
            return back()->with('error', 'Gagal mengubah status. Stok buku ini sedang kosong!');
        }

        $requestData = [
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'status' => $request->status
        ];

        Transaksi::updateTransaksi($id, $requestData, $transaksiLama);

        return redirect('/transaksi')->with('sukses', 'Data transaksi berhasil diperbarui!');
    }
}
