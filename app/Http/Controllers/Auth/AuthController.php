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

            /**
             * 3. PROSES KONVERSI PASSWORD FORM KE XOR
             * Kita instansiasi objek Model User baru agar bisa menggunakan
             * fungsi Mutator (SetAttribute) password biner XOR yang sudah kita buat kemarin.
             */
            $tempUser = new User();
            $tempUser->password = $request->password; // Mengonversi password ketikan menjadi biner XOR otomatis

            $passwordXorHasilKetikan = $tempUser->password;

            /**
             * 4. COCOKKAN HASIL XOR
             * Bandingkan apakah biner XOR hasil ketikan form SAMA PERSIS
             * dengan biner XOR yang tersimpan di kolom database.
             */
            if ($passwordXorHasilKetikan === $user->password) {

                // Jika cocok, buat Session seperti sistem lama kamu
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

        // Jika username tidak ketemu ATAU password XOR-nya tidak cocok
        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        Session::flush();

        return redirect('/login');
    }
}
