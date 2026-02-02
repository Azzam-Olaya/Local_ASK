<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('Pages.register');
    }
    public function login()
    {
        return view('Pages.login');
    }

    public function submit_register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
    public function submit_login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home')->with('success', 'Login successful.');
        }
        return redirect()->route('home')->with('failed', 'Login failed.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}
