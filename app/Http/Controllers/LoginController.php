<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
    $request->session()->regenerate(); // penting

    $user = Auth::user();

    if ($user->role_id == 1) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('operasional'); // arahkan user biasa ke sini
    }
}
        return back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegistrationForm()
    {
        return view('login/register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => [
            'required',
            'min:8',
            'regex:/[A-Z]/',
            'regex:/[a-z]/',
            'regex:/[0-9]/',
        ],
    ], [
        'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan angka'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => 2
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil!');
}
}
