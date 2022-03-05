<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Models\User;
use App\Models\Waitlist;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use GeneralTrait;

    public function me(Request $request)
    {
        return Auth::user();
    }

    public function publicProfile(Request $request)
    {
        $request->validate(['username' => 'required']);

        $user = User::query()->whereRaw('lower(username) = ?', [strtolower($request->username)])
            ->with(['creatorProfile' => function ($q) {
                $q->select('id', 'user_id', 'instagram_handler', 'instagram_meta->profile_pic_url as instagram_profile_pic');
            }])->select('id',
                'first_name',
                'last_name',
                'username',
                'email',
                'profile_pic_url',
                'is_verified',
                'title',
                'employer',
                'employer_link',
                'call_to_action_text',
                'call_to_action',
                'show_instagram'
            )->first();
        if ($user) {
            $user->profile_pic_url = $this->getProfilePic($user);
            $user->name = $user->first_name ? ($user->first_name.' '.$user->last_name) : $user->username;
            return response([
                'status' => true,
                'data' => $user,
                'networks' => Creator::NETWORKS,
            ], 200);
        }

        // check in creators now

        $user = Creator::query()->whereRaw('lower(platform_username) = ?', [strtolower($request->username)])
            ->select(
                'id',
                'first_name',
                'last_name',
                'full_name',
                'platform_username as username',
                'platform_verified as is_verified',
                'platform_title as title',
                'platform_employer as employer',
                'platform_employer_link as employer_link',
                'instagram_handler',
                'instagram_meta->profile_pic_url as instagram_profile_pic',
                'instagram_meta->external_link as external_link as call_to_action'
            )->first();

        if ($user) {
            $user['creator_profile'] = [
                'instagram_handler' => $user->instagram_handler,
            ];
            $user->name = $user->first_name ? ($user->first_name.' '.$user->last_name) : ($user->full_name ?? $user->username);
            $user->profile_pic_url = $this->getProfilePic($user);
            $user->call_to_action_text = 'Follow Instagram';
            $user->call_to_action = $this->getCta($user);

            // when user is from creator default each link to show
            $user->show_instagram = true;
            return response([
                'status' => true,
                'data' => $user,
                'networks' => Creator::NETWORKS,
            ], 200);
        }

        return response([
            'status' => false,
            'message' => 'Creator not found.'
        ]);
    }

    public function getCta($user)
    {
        if ($user->call_to_action) return $user->call_to_action;

        $cta = null;
        foreach (Creator::NETWORKS as $network) {
            if ($cta = $user[$network.'_handler']) break;
        }
        return $cta;
    }

    public function getProfilePic(&$user)
    {
        // hack to check if user is from creators
        if (!$user->email) {
            foreach (Creator::NETWORKS as $network) {
                if ($profile_pic = $user[$network.'_profile_pic']) break;
            }
            foreach (Creator::NETWORKS as $network) {
                unset($user[$network.'_profile_pic']);
            }
            return $profile_pic;
        }

        if ($user->profile_pic_url) return $user->profile_pic_url;

        if (is_null($user->creatorProfile)) return $user->default_image;

        $profile_pic = null;
        foreach (Creator::NETWORKS as $network) {
            $profile = $user->creatorProfile;
            if ($profile_pic = $profile[$network.'_profile_pic']) break;
        }
        foreach (Creator::NETWORKS as $network) {
            unset($user->creatorProfile[$network.'_profile_pic']);
        }
        return $profile_pic ?? $user->default_image;
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'profile_pic_url' => 'nullable|image',
        ]);
        $path = null;
        if (Auth::user()->profile_pic_url) {
            $filename = explode(User::UPLOAD_PATH, Auth::user()->profile_pic_url)[1];
            $path = User::UPLOAD_PATH.$filename;
        }
        if ($request->profile_pic_url) {
            $file = self::uploadFile($request->profile_pic_url, User::UPLOAD_PATH, $path);
            $data['profile_pic_url'] = $file;
        }
        $user = User::where('id', Auth::user()->id)->update($data);
        if ($user) {
            return collect([
                'status' => true,
                'message' => 'Profile Information Updated.',
                'user' => User::where('id', Auth::user()->id)->first()
            ]);
        }
        return collect([
            'status' => false,
            'message' => 'Something went wrong. Please try again later.'
        ]);
    }

    public function removeProfilePhoto(Request $request)
    {
        $user = Auth::user();
        if ($profile = $user->getRawOriginal('profile_pic_url')) {
            if (Storage::disk('s3')->delete($profile)) {
                User::where('id', $user->id)->update(['profile_pic_url' => null]);
                return collect([
                    'status' => true,
                    'message' => 'Profile photo removed.',
                    'user' => Auth::user()
                ]);
            } else {
                return collect([
                    'status' => false,
                    'message' => 'Failed to remove profile photo.'
                ]);
            }
        }
        return collect([
            'status' => false,
            'message' => 'No profile photo to remove.'
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
