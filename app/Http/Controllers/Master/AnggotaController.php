<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index() {
        $anggota = DB::table('anggota')->get();
        return view ('anggota.index', compact('anggota'));
    }

    public function create(){
        return view('anggota.create');
    }

    public function store(Request $request){
        DB::table('anggota')->insert([
            'nama'=> $request->nama,
            'alamat'=> $request->alamat,
            'no_hp'=> $request->no_hp,
        ]);

        return redirect('/anggota');
    }

    public function edit($id){
        $anggota = DB::table('anggota')->where('id', $id)->first();
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id){
        DB::table('anggota')
        ->where('id', $id)
        ->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect('/anggota');
    }

    public function destroy($id){
        DB::table('anggota')->where('id', $id)->delete();
        return redirect('/anggota');
    }
}
