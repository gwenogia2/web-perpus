<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User; // Memanggil Model User untuk meminjam fungsi XOR-nya

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input form login terlebih dahulu
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // 2. Cari user di database hanya berdasarkan 'username' saja
        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        if ($user) {


            $tempUser = new User();
            $tempUser->password = $request->password;
            dd($request->password ); // Mengonversi password ketikan menjadi biner XOR otomatis
            $passwordXorHasilKetikan = $tempUser->password;



            if ($passwordXorHasilKetikan === $user->password) {

                // Kalo cocok, buat Session
                Session::put([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role
                ]);

                // Redirect berdasarkan role
                if ($user->role == 'admin') {
                    return redirect('/dashboard');
                }

                if ($user->role == 'siswa') {
                    return redirect('/dashboard-siswa');
                }
            }
        }

        // Jika username tidak ketemu or password XOR-nya tidak cocok
        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        Session::flush();

        return redirect('/login');
    }
}
