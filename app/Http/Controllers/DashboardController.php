<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    $totalAnggota = DB::table('anggota')->count();
    $totalBuku = DB::table('buku')->count();
    $dipinjam = DB::table('transaksi')
                    ->where('status', 'pinjam')
                    ->count();

    $totalDenda = 0; // sementara

    return view('dashboard.index', compact(
        'totalAnggota',
        'totalBuku',
        'dipinjam',
        'totalDenda'
    ));
}
}