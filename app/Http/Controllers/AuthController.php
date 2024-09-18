<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function authenticating(Request $request)
    {
        // menampung input user
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // cek apakah login valid
        if (Auth::attempt($credentials)) {
            // cek apakah status = active || jika status inactive
            if (Auth::user()->status != 'active')
            {
            // paksa keluar jika status inactive 
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            // notif jika akun inactive
                Session::flash('status', 'failed');
                Session::flash('message', 'Your account is not active yet. Please contact admin !');
                return redirect('login');
            }
            // regenerate session 
            $request->session()->regenerate();
            // cek jika login sebagai admin ke halaman dashboard 
            if(Auth::user()->role_id == 1){
                Session::flash('status', 'success');
                Session::flash('message', 'Login Success!');
                return redirect('dashboard');
            }
            // cek jika login sebagai client ke halaman profile
            // if(Auth::user()->role_id == 2){
            //     return redirect ('profile');
            // }
        }
        // jika username & password tidak sesuai 
        Session::flash('status', 'failed');
        Session::flash('message', 'Incorrect email or password !');
        return redirect('login');
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
        Session::flash('message', 'Register successfully, waiting admin for approval!');
        return redirect('register');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
