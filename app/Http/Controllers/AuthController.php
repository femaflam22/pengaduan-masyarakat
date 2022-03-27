<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function check(Request $request)
    {
        if (!Auth::check()) {
            return view('login');
        }
        return redirect()->route('admin.report_table');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();
        $credentials = request(['username', 'password']);
        if (!$user || !Auth::attempt($credentials)) {
            return redirect()->route('check_for_login')->with('failed', 'Password salah! silahkan login kembali dengan memastikan data benar.');
        } else {
            Auth::login($user);
            return redirect()->route('admin.report_table');
        }
    }

    public function accounts()
    {
        $data = User::orderBy('created_at', 'DESC')->get();
        $no = 1;

        return view('admin.accounts', compact('data', 'no'));
    }

    public function register()
    {
        return view('admin.register');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'telp' => 'required',
            'level' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();
        if(!$user) {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'telp' => $request->telp,
                'password' => Hash::make($request->username),
                'level' => $request->level
            ]);

            return redirect()->route('admin.accounts')->with('success', 'Akun baru berhasil dibuat!');
        } else {
            return redirect()->back()->with('failed', 'Username sudah tersedia! Mohon untuk menggunakan username lain.');
        }
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->first();

        return view('admin.edit_account', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $update = User::where('id', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'telp' => $request->telp,
            'password' => Hash::make($request->username),
            'level' => $request->level
        ]);

        if ($update) {
            return redirect()->route('admin.accounts')->with('success', 'Akun berhasil diperbarui!');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
