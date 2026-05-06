<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index()
    {
        $buku = DB::table('buku')->get();
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        DB::table('buku')->insert([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'stok' => $request->stok,
        ]);

        return redirect('/buku');
    }

    public function edit($id)
    {
        $buku = DB::table('buku')->where('id', $id)->first();
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        DB::table('buku')
            ->where('id', $id)
            ->update([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahun' => $request->tahun,
                'stok' => $request->stok,
            ]);

        return redirect('/buku');
    }

    public function destroy($id)
    {
        DB::table('buku')->where('id', $id)->delete();
        return redirect('/buku');
    }
}