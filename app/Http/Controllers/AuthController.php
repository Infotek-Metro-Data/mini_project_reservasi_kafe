<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{

    public function showLogin()
    {
        $roles = Role::all();
        return view('auth.login', compact('roles'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required|exists:roles,id'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth()->user()->role_id != $request->role_id) {
                Auth::logout();
                return back()->withErrors([
                    'role_id' => 'Role yang dipilih tidak sesuai dengan akun Anda.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return $this->redirectBasedOnRole(auth()->user());
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        Auth::login($user);

        return $this->redirectBasedOnRole($user);
    }

    private function redirectBasedOnRole($user)
    {
        $roleName = $user->role->name;

        switch ($roleName) {
            case 'admin':
                return redirect()->route('dashboard')->with('success', 'Selamat datang Admin!');
            case 'petugas':
                return redirect()->route('dashboard')->with('success', 'Selamat datang Petugas!');
            case 'karyawan':
                return redirect()->route('dashboard')->with('success', 'Selamat datang Karyawan!');
            default:
                return redirect()->route('dashboard');
        }
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        return back()->with('success', 'Link reset password telah dikirim ke email Anda!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}