<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Waitlist;
use App\Repositories\CustomAuth0UserRepository;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use GeneralTrait;

    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new CustomAuth0UserRepository();
    }

    public function me(Request $request)
    {
        $auth0 = \App::make('auth0');

        $accessToken = $request->bearerToken() ?? "";
        $tokenInfo = $auth0->decodeJWT($accessToken);
        return $this->userRepo->getUserByDecodedJWT($tokenInfo);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'profile_pic_url' => 'nullable|image',
        ]);
        $file = self::uploadFile($request->profile_pic_url, User::UPLOAD_PATH, Auth::user()->profile_pic_url ?? null);
        $data['profile_pic_url'] = $file;
        $user = User::where('id', Auth::user()->id)->update($data);
        if ($user) {
            $auth0 = \App::make('auth0');
            $accessToken = $request->bearerToken() ?? "";
            $tokenInfo = $auth0->decodeJWT($accessToken);
            return collect([
                'status' => true,
                'message' => 'Profile Information Updated.',
                'user' => $this->userRepo->getUserByDecodedJWT($tokenInfo)
            ]);
        }
        return collect([
            'status' => false,
            'message' => 'Something went wrong. Please try again later.'
        ]);
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
