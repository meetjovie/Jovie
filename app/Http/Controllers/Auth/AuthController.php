<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard()->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $token = $request->user()->createToken('jovie_extension');

            return response()->json([
                'status' => true,
                'token' => $token->plainTextToken,
                'user' => User::currentLoggedInUser(),
            ], 200);
        }

        return response()->json([
            'status' => false,
            'error' => 'Your email or password is incorrect.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([], 204);
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $teamModel = config('teamwork.team_model');

        $team = $teamModel::create([
            'name' => ($request->first_name."'s Team"),
            'owner_id' => $user->id,
        ]);
        $team->credits = 10;
        $team->save();
        $user->attachTeam($team);

        Auth::login($user);

        return response()->json([
            'status' => true,
            'user' => User::currentLoggedInUser(),
        ], 200);
    }

    public function validateStep1(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
}
