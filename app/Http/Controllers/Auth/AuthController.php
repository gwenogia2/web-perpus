<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin() {
        return view ('auth.login');
    }

    public function login(Request $request) {
        
        $user = DB::table('users')
            ->where('username', $request->username)
            ->where('password', md5($request->password))
            ->first();

        if ($user){
            Session::put('user_id', $user->id);
            Session::put('username', $user->username);
            Session::put('role',$user->role);

            return redirect('/dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout() {

        Session::flush();
        return redirect('/login');
    }
}
