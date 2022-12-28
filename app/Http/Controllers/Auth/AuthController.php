<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\DefaultCrm;
use App\Models\Creator;
use App\Models\User;
use App\Models\UserList;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Socialite\Facades\Socialite;

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

    public function loginUser(Request $request)
    {
        $token = $request->header('authorization');
        if (!empty($token)) {
            $token = str_replace('Bearer ', '', $token);
            $user = PersonalAccessToken::findToken($token)->tokenable ?? null;
            if ($user) {
                Auth::guard()->login($user);
                $request->session()->regenerate();
                $token = $request->user()->createToken('jovie_extension');

                return response()->json([
                    'status' => true,
                    'token' => $token->plainTextToken,
                    'user' => User::currentLoggedInUser(),
                ], 200);
            }
        }

        return response()->json([
            'status' => false,
            'error' => 'Token missing',
        ]);
    }

    public function loginUserExtension(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'error' => 'Your email or password is incorrect.',
            ]);
        }

        $token = $user->createToken('jovie_extension');
        return response()->json([
            'status' => true,
            'token' => $token->plainTextToken,
            'user' => User::currentLoggedInUser($user->id),
        ], 200);
    }

    public function logout(Request $request)
    {
//        $request->user()->tokens()->delete();
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

        DB::transaction(function () use ($request) {
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

            event(new Registered($user));

            Auth::login($user);

            DefaultCrm::dispatch($user->id, $team->id);
        });

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

    public function redirect(string $network)
    {
        $socialite = Socialite::driver($network);
        if ($network == 'reddit') {
            $socialite = $socialite
                ->with(['duration' => 'permanent'])->setScopes(['identity', 'submit', 'flair', 'modflair', 'privatemessages']);
        } elseif ($network == 'google') {
            $socialite = $socialite->with(["access_type" => "offline", "prompt" => "consent select_account"]);
        } elseif ($network == 'facebook') {
            $socialite = $socialite->setScopes(['pages_show_list', 'pages_manage_metadata', 'pages_messaging', 'pages_read_engagement', 'instagram_basic', 'instagram_manage_messages']);
        }
//        dd($socialite);
        return $socialite->redirect();
    }

    public function callback(string $network)
    {
        $user = Socialite::driver($network)->stateless()->user();

        $names = explode(' ', $user->name);
        $user = User::query()->updateOrCreate([
            'google_id' => $user->id
        ], [
            'first_name' => $names[0],
            'last_name' => $names[1] ?? null,
            'email' => $user->email,
            'profile_pic_url' => $user->avatar,
            'password' => Hash::make(rand(1, 10)),
        ]);

        if ($user->wasRecentlyCreated) {
            $teamModel = config('teamwork.team_model');

            $team = $teamModel::create([
                'name' => ($names[0]."'s Team"),
                'owner_id' => $user->id,
            ]);
            $team->credits = 10;
            $team->save();
            $user->attachTeam($team);

            DefaultCrm::dispatch($user->id, $team->id);
        }

        Auth::login($user);

        return redirect()->route('welcome');
    }

    public function verify(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if (!$request->user()->validateCode()) {

        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
