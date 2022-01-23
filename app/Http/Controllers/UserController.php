<?php

namespace App\Http\Controllers;

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
}
