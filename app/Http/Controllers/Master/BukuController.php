<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::getAll();

        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'stok' => $request->stok,
            'created_at' => now(),
            'updated_at' => now()
        ];

        Buku::simpan($data);

        return redirect('/buku')->with('sukses', 'Data buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $buku = Buku::findById($id);

        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'stok' => $request->stok,
            'updated_at' => now()
        ];

        Buku::ubah($id, $data);

        return redirect('/buku')->with('sukses', 'Data buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Buku::hapus($id);

        return redirect('/buku')->with('sukses', 'Data buku berhasil dihapus!');
    }

    public function list()
    {
        $buku = Buku::getAll();

        return view('buku.list', compact('buku'));
    }
}
