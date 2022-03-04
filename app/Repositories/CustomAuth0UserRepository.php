<?php

namespace App\Repositories;

use App\Models\User;

use Auth0\Login\Auth0User;
use Auth0\Login\Auth0JWTUser;
use Auth0\Login\Repository\Auth0UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Segment\Segment;

class CustomAuth0UserRepository extends Auth0UserRepository
{
    public function upsertUser( $profile ) {
        $user = User::firstOrCreate(['sub' => $profile['sub']], [
            'email' => $profile['email'] ?? '',
            'first_name' => $profile['name'] ?? '-',
            'last_name' => $profile['last_name'] ?? '-',
        ]);
        if ($user) {
//            if ($user->is_admin && !$user->subscribed()) {
//                $subscription = $user->subscriptions()->create([
//                    'name' => 'default',
//                    'stripe_id' => Str::random(10),
//                    'stripe_status' => 'active',
//                    'stripe_plan' => collect(config('spark.billables.user.plans'))->first()['yearly_id'] ?? 'price_1KCpgOIDxrKL9CaGrIpO4v5u',
//                    'quantity' => 1,
//                    'trial_ends_at' => null,
//                    'ends_at' => null,
//                ]);
//
//                $subscription->items()->create([
//                    'stripe_id' => Str::random(10),
//                    'stripe_plan' => collect(config('spark.billables.user.plans'))->first()['yearly_id'] ?? 'price_1KCpgOIDxrKL9CaGrIpO4v5u',
//                    'quantity' => 1,
//                ]);
//            }
        }
//        Segment::identify(array(
//            "userId" => $user->sub,
//            "traits" => array(
//                "email" => $user->email,
//                "name" => $user->name,
//            )
//        ));
        return $user;
    }

    public function getUserByDecodedJWT(array $decodedJwt) : Authenticatable
    {
        return $this->upsertUser( $decodedJwt );
        return new Auth0JWTUser( $user->getAttributes() );
    }

    public function getUserByUserInfo(array $userinfo) : Authenticatable
    {
        $user = $this->upsertUser( $userinfo['profile'] );
        return $user;
    }

    public static function currentUser($request)
    {
        if (config('app.local') === true) {
            return User::first();
        }
        $auth0 = \App::make('auth0');
        $accessToken = $request->bearerToken() ?? "";
        $tokenInfo = $auth0->decodeJWT($accessToken);
        $userRepo = new CustomAuth0UserRepository();
        return $userRepo->getUserByDecodedJWT($tokenInfo);
    }
}
