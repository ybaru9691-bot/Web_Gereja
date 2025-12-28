<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // 2. Ambil email & password
        $credentials = $request->only('email', 'password');

        // 3. Coba login
        if (Auth::attempt($credentials)) {

            // 4. Regenerasi session (keamanan)
            $request->session()->regenerate();

            // 5. Ambil user yang login
            $user = Auth::user();

            // 6. Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'pendeta') {
                return redirect()->route('pendeta.dashboard');
            }

            // 7. Default jemaat
            return redirect()->route('home');
        }

        // 8. Jika gagal login
        return back()
            ->withInput()
            ->with('error', 'Email atau password salah');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
