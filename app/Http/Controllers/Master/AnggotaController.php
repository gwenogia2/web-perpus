<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::getAll();

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'created_at' => now(),
            'updated_at' => now()
        ];

        Anggota::simpan($data);

        return redirect('/anggota')->with('sukses', 'Data anggota berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $anggota = Anggota::findById($id);

        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'updated_at' => now()
        ];

        Anggota::ubah($id, $data);

        return redirect('/anggota')->with('sukses', 'Data anggota berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Anggota::hapus($id);

        return redirect('/anggota')->with('sukses', 'Data anggota berhasil dihapus!');
    }
}
