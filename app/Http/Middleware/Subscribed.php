<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Subscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::currentLoggedInUser();
        if ($user->is_admin || ($user->currentTeam->current_subscription && $user->currentTeam->subscribed($user->currentTeam->current_subscription->name))) {
            return $next($request);
        }
        return response()->json(["message" => "You are not subscribed. Please upgrade your plan."], 401);
    }
}
