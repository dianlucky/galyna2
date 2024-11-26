<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Show Login Form
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate Input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Attempt to login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Check Role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('admin/dashboard');
            }

            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        // Logout
        Auth::logout();

        // Invalidate Session
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
