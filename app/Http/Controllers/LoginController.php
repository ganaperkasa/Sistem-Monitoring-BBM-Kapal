<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $user = Auth::user();

            //cek role user
            if ($user->role_id == 1) {
            return redirect()->route('dashboard');
        } else {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Unauthorized access.',
            ]);
        }


    }
    return back()->with('error', 'Email atau password salah!');
    }

        public function logout()
        {
            Auth::logout();
            return redirect()->route('login');
        }
}
