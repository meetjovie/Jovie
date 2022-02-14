<?php

namespace App\Http\Middleware;

use App\Repositories\CustomAuth0UserRepository;
use Closure;
use Illuminate\Http\Request;

class Admin
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
    public function handle(Request $request, Closure $next)
    {
        if ($this->userRepository->currentUser($request)->is_admin) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized user'], 401);
    }
}
