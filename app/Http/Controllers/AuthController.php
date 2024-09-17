<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function registerProcess(Request $request) {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255|email',
            'password' => 'required|min:8|confirmed', // Menambahkan konfirmasi password
        ]);

        // Hash the password before saving
        $validated['password'] = Hash::make($validated['password']);

        // Create the user
        User::create($validated);

        Session::flash('status', 'success');
        Session::flash('message', 'Registrasi successfully, waiting admin for approval!');
        return redirect('register');
    }
}
