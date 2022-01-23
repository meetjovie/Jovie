<?php
// app/Http/Middleware/CheckJWT.php

namespace App\Http\Middleware;

use App\Repositories\CustomAuth0UserRepository;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\InvalidTokenException;
use Closure;

class CheckAuth0JWT
{
    protected $userRepository;

    /**
     * CheckJWT constructor.
     *
     * @param CustomAuth0UserRepository $userRepository
     */
    public function __construct(CustomAuth0UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth0 = \App::make('auth0');

        $accessToken = $request->bearerToken() ?? "";
        try {
            $tokenInfo = $auth0->decodeJWT($accessToken);
            $user = $this->userRepository->getUserByDecodedJWT($tokenInfo);
            $this->userRepository->upsertUser($user);
            if (!$user) {
                return response()->json(["message" => "Unauthorized user"], 401);
            }

        } catch (InvalidTokenException $e) {
            return response()->json(["message" => $e->getMessage()], 401);
        } catch (CoreException $e) {
            return response()->json(["message" => $e->getMessage()], 401);
        }

        return $next($request);
    }
}
