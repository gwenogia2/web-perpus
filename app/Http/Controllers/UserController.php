<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data_user = User::all();
        return view('user.index', compact('data_user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create($request->all());

        return redirect()->back()->with('sukses', 'Berhasil!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'role' => 'required'
        ]);

        $input = $request->all();

        if ($request->filled('password')) {
            $input['password'] = $request->password;
        } else {
            unset($input['password']);
        }

        $user->update($input);

        return redirect('/user')->with('sukses', 'Data user berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/user')->with('sukses', 'User berhasil dihapus dari sistem!');
    }
}
