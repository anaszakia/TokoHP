<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Cek apakah user memiliki role 'user'
            if ($user->hasRole('user')) {
                return redirect()->route('beranda');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda tidak memiliki akses sebagai User.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'no_hp' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string|max:255',
            'province_id' => 'required|string|max:255',
            'city_id' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat_lengkap' => $request->alamat_lengkap,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'kode_pos' => $request->kode_pos,
        ]);

        // Assign role 'user' menggunakan Spatie Permission
        $user->assignRole('user');

        // Login user setelah register
        Auth::login($user);
        
        return redirect()->route('beranda');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('beranda');
    }
}