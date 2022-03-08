<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|min:8'
            ]);

        if (Auth::guard()->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return response()->json([
                'status' => true,
                'user' => Auth::user()
            ], 200);
        }

        return response()->json([
            'status' => false,
            'error' => 'Invalid credentials'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([], 204);
    }
}
