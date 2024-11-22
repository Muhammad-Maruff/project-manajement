<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.profile', ['title' => 'Profile']);
    }

    public function update(Request $request) {
        // Validasi input
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);
    
        // Update data pengguna
        $user = Auth::user();
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->address = $validatedData['address'];
        $user->save();
    
        // Mengembalikan respons dengan properti 'success'
        return response()->json([
            'success' => true,  // Pastikan properti ini ada
            'message' => 'Profile updated successfully'
        ]);
    }
    
    
}
