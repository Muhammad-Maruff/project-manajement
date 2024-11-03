<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            if(Auth::user()->role_id == 2){
                return redirect ('profile');
            }
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
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'password' => 'required|min:8|confirmed',
        ]);

        // dd($validated);

        // Hash the password before saving
        $validated['password'] = Hash::make($validated['password']);

        // Create the user
        User::create($validated);

        Session::flash('status', 'success');
        Session::flash('message', 'Register successfully, waiting admin for approval!');
        return redirect('register');
    }

    public function forgotPassword() {
        return view ('forgot_password');
    }

    public function forgotPasswordProcess(Request $request) {
        $customMessage = [
            'email.exists' => 'Email not registered !'
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email'  // Fix typo: change 'exist' to 'exists'
        ], $customMessage);

        $token = Str::random(60);

        PasswordReset::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        Mail::to($request->email)->send(new ResetPasswordMail($token));
    
        // Simulate sending email process (you can replace this with actual email sending logic)
    
        return redirect()->route('forgot-password')->with([
            'status' => 'success',
            'message' => 'Password reset link has been sent !'
        ]);
    }

    public function validateForgotPassword(Request $request, $token) {
        $getToken = PasswordReset::where('token', $token)->first();

        if (!$getToken) {
            return redirect()->route('login')->with('failed', 'invalid token');
        }

        return view ('reset_password', compact('token'));
    }

    public function validateForgotPasswordProcess(Request $request) {
        $customMessage = [
            'password.required' => 'Password cannot be empty!'
        ];
    
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ], $customMessage);
    
        $token = PasswordReset::where('token', $request->token)->first();

    
        if (!$token) {
            return redirect()->route('login')->with([
                'status' => 'failed',
                'message' => 'Invalid token!'
            ]);
        }
    
        $user = User::where('email', $token->email)->first();
    
        if (!$user) {
            return redirect()->route('login')->with([
                'status' => 'failed',
                'message' => 'Email not registered!'
            ]);
        }
    
        $user->update([
            'password' => Hash::make($request->password)
        ]);
    
        $token->delete();
    
        return redirect()->route('login')->with([
            'status' => 'success',
            'message' => 'Reset Password Successfully!'
        ]);
    }
     

    public function resetPassword () {
        return view ('reset_password');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
