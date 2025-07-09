<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        // dd(Auth::attempt(['email' => 'admin@gmail.com', 'password' => 'pelaihari123']));
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('admin/dashboard');
            }

            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegisterForm()
    {
        // Show Register Form
        return view('auth.register');
    }


    public function register(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();
        $data = [
            'name' => $request->name ?? 'Pelanggan',
        ];
        Mail::to($request->email ?? 'imelda.aryani@mhs.politala.ac.id')->send(new RegisterMail($data));
        // Return back with success message
        session()->flash('success', 'Registrasi akun berhasil!');
        return redirect('/login');
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
