<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // kalau admin, langsung ke halaman admin
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/barang');
            }

            return redirect('/barang');
        }

        // kalau gagal balik lagi ke login
        return back()->withErrors([
            'email' => 'Email atau password salah nih!',
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|min:3|max:40',
            'email'        => 'required|string|ends_with:@gmail.com|unique:users,email',
            'password'     => 'required|string|min:6|max:12|confirmed',
            'no_hp'        => 'required|string|starts_with:08|min:9|max:13',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'name'         => $request->nama_lengkap, // kolom name juga diisi biar gak error
            'email'        => $request->email,
            'password'     => bcrypt($request->password),
            'no_hp'        => $request->no_hp,
            'role'         => 'user', // register biasa selalu jadi user
        ]);

        // langsung login setelah register
        Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        return redirect('/barang');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}