<?php

namespace App\Http\Controllers;

use App\Models\Waitlist;
use App\Repositories\CustomAuth0UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request)
    {
        $auth0 = \App::make('auth0');

        $accessToken = $request->bearerToken() ?? "";
        $tokenInfo = $auth0->decodeJWT($accessToken);
        $userRepo = new CustomAuth0UserRepository();
        $user = $userRepo->getUserByDecodedJWT($tokenInfo);
        return $user;
    }

    public function addToWaitList(Request $request)
    {
        $request->validate(['email' => 'required|email|max:255']);
        $status = Waitlist::updateOrCreate(['email' => $request->email], ['email' => $request->email]);
        if ($status) {
            return collect([
                'status' => true,
                'message' => 'Added to wait list'
            ]);
        }
        return collect([
            'status' => false,
            'message' => 'Something went wrong. Please try again later.'
        ]);
    }
}
