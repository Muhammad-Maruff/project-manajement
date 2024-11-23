<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProfileController extends Controller
{
    public function index() {
        return view('profile.profile', ['title' => 'Profile']);
    }
    
    public function update(Request $request) {
        $user = Auth::user();
    
        try {
            $validateData = $request->validate([
                'username' => 'required|unique:users,username,' . $user->id . '|max:255',
                'email'    => 'required|unique:users,email,' . $user->id . '|max:255|email',
                'phone'    => 'required|string|max:20',
                'address'  => 'required|string|max:255',
            ]);
    
       
            $user->username = $validateData['username'];
            $user->email    = $validateData['email'];
            $user->phone    = $validateData['phone'];
            $user->address  = $validateData['address'];
            $user->save();
    
    
            return response()->json([
                'success' => true,
                'message' => 'Profile update successfully !',
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        }
    }
    
}
