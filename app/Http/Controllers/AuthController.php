<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // LOGIN ADMIN (HARDCODE)
        if ($request->username === 'admin' && $request->password === 'admin123') {
            session(['role' => 'admin', 'username' => 'admin']);
            return redirect()->route('jenis-layanan.index');
        }

        // LOGIN USER
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Username / Password salah');
        }

        session([
            'role' => 'user',
            'user_id' => $user->id,
            'username' => $user->username
        ]);

        return redirect()->route('transaksi.index');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:5'
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        // AUTO LOGIN
        session([
            'role' => 'user',
            'user_id' => $user->id,
            'username' => $user->username
        ]);

        return redirect()->route('transaksi.index');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}

