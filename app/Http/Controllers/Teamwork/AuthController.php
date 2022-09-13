<?php

namespace App\Http\Controllers\Teamwork;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Mpociot\Teamwork\Facades\Teamwork;
use Mpociot\Teamwork\TeamInvite;

class AuthController extends Controller
{
    /**
     * Accept the given invite.
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptInvite($token)
    {
        $invite = Teamwork::getInviteFromAcceptToken($token);
        if (! $invite) {
            return response([
                'status' => false,
            ], 404);
        }

        if (auth()->check()) {
            Teamwork::acceptInvite($invite);

            return response([
                'status' => true,
                'message' => 'Accepted',
            ]);
        } else {
            session(['invite_token' => $token]);

            return response([
                'status' => false,
                'message' => 'Login',
                'invite_token' => $token,
            ]);
        }
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response([
                'status' =>  true,
                'message' => __($status),
            ], 200);
        }

        throw ValidationException::withMessages([
            'email' => [__($status)]
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response([
                'status' =>  true,
                'message' => __($status),
            ], 200);
        }

        throw ValidationException::withMessages([
            'email' => [__($status)]
        ]);
    }
}

