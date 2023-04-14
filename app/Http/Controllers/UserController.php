<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Creator;
use App\Models\Import;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserList;
use App\Models\Waitlist;
use App\Rules\MatchOldPassword;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    use GeneralTrait;

    public function me(Request $request)
    {
        return User::currentLoggedInUser();
    }

    public function publicProfile(Request $request)
    {
        $request->validate(['username' => 'required']);

//        $user = User::query()->whereRaw('lower(username) = ?', [strtolower($request->username)])
//            ->with(['contactProfile' => function ($q) {
//                $q->select('id', 'user_id', 'instagram_handler', 'instagram_meta->profile_pic_url as instagram_profile_pic');
//            }])->select('id',
//                'first_name',
//                'last_name',
//                'username',
//                'email',
//                'profile_pic_url',
//                'is_verified',
//                'title',
//                'employer',
//                'employer_link',
//                'call_to_action_text',
//                'call_to_action',
//                'show_instagram',
//                'instagram_handler',
//                'tiktok_handler',
//                'twitter_handler',
//                'twitch_handler',
//                'youtube_handler',
//                'show_tiktok',
//                'show_youtube',
//                'show_twitter',
//                'show_twitch',
//            )->first();
        $user = User::query()->select([
            'id',
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
            'show_instagram',
            'instagram_handler',
            'show_tiktok',
            'show_youtube',
            'show_twitter',
            'show_twitch',
        ])->whereRaw('lower(username) = ?', [strtolower($request->username)])->first();
        if ($user) {
            $contact = Contact::getPublicProfile($user->id);
            $user->name = $user->full_name;
            if (is_null($contact)) {
                $socials = [];
                foreach (Creator::NETWORKS as $network) {
                    $socials[] = [
                        'network' => $network,
                        'url' => $user->{$network.'_handler'}
                    ];
                }
                $contact = [
                    'social_links_with_followers' => $socials
                ];
            }
            $user->contact = $contact;
            return response([
                'status' => true,
                'data' => $user,
                'networks' => Creator::NETWORKS,
            ], 200);
        }

        // check in creators now

        $contact = Contact::getPublicProfile($request->username, true);

        if ($contact) {
            $user = (object) [];
            $user->name = $contact->full_name;
            $user->first_name = $contact->first_name;
            $user->last_name = $contact->last_name;
            $user->profile_pic_url = $contact->profile_pic_url;
            $user->call_to_action_text = 'Follow';
            $user->call_to_action = $this->getCta($contact);

            // when user is from creator default each link to show
            foreach (Creator::NETWORKS as $network) {
                $user->{'show_'.$network} = true;
            }

            $user->contact = $contact;

            return response([
                'status' => true,
                'data' => $user,
                'networks' => Creator::NETWORKS,
            ], 200);
        }

        return response([
            'status' => false,
            'message' => 'Contact not found.',
        ]);
    }

    public function getCta($user)
    {
        if ($user->call_to_action) {
            return $user->call_to_action;
        }

        $cta = null;
        foreach (Creator::NETWORKS as $network) {
            if ($cta = $user[$network]) {
                break;
            }
        }

        return $cta;
    }

    public function getProfilePic(&$user)
    {
        // hack to check if user is from creators
        if (! $user->email) {
            foreach (Creator::NETWORKS as $network) {
                if ($profile_pic = $user[$network.'_profile_pic']) {
                    break;
                }
            }
            foreach (Creator::NETWORKS as $network) {
                unset($user[$network.'_profile_pic']);
            }

            return $profile_pic;
        }

        if ($user->profile_pic_url) {
            return $user->profile_pic_url;
        }

        if (is_null($user->creatorProfile)) {
            return $user->default_image;
        }

        $profile_pic = null;
        foreach (Creator::NETWORKS as $network) {
            $profile = $user->creatorProfile;
            if ($profile_pic = $profile[$network.'_profile_pic']) {
                break;
            }
        }
        foreach (Creator::NETWORKS as $network) {
            unset($user->creatorProfile[$network.'_profile_pic']);
        }

        return $profile_pic ?? $user->default_image;
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'sometimes|max:255',
            'last_name' => 'sometimes|max:255',
            'profile_pic_url' => 'sometimes|nullable|string',
            'username' => 'sometimes|nullable|string',
            'facebook_handler' => 'sometimes|nullable|string',
            'twitter_handler' => 'sometimes|nullable|string',
            'instagram_handler' => 'sometimes|nullable|string',
            'youtube_handler' => 'sometimes|nullable|string',
            'tiktok_handler' => 'sometimes|nullable|string',
            'twitch_handler' => 'sometimes|nullable|string',
        ]);
        if ($request->profile_pic_url) {
            Storage::disk('s3')->copy(
                ('tmp/'.$request->input('profile_pic_url')),
                (User::UPLOAD_PATH.$request->input('profile_pic_url'))
            );
            $data['profile_pic_url'] = Storage::disk('s3')->url((User::UPLOAD_PATH.$request->input('profile_pic_url')));
        }
        $user = User::where('id', Auth::user()->id)->first();
        foreach ($data as $k => $v) {
            $user->{$k} = $v;
        }
        $user->save();

        if (isset($data['profile_pic_url'])) {
            if (Auth::user()->getRawOriginal('profile_pic_url')) {
                $filename = explode(User::UPLOAD_PATH, Auth::user()->profile_pic_url)[1] ?? null;
                if (! is_null($filename)) {
                    $path = User::UPLOAD_PATH.$filename;
                    Storage::disk('s3')->delete($path);
                }
            }
        }

        if ($user) {
            return collect([
                'status' => true,
                'message' => 'Profile Information Updated.',
                'user' => User::currentLoggedInUser()
            ]);
        }

        return collect([
            'status' => false,
            'message' => 'Something went wrong. Please try again later.',
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
                    'user' => User::currentLoggedInUser()
                ]);
            } else {
                return collect([
                    'status' => false,
                    'message' => 'Failed to remove profile photo.',
                ]);
            }
        }

        return collect([
            'status' => false,
            'message' => 'No profile photo to remove.',
        ]);
    }

    public function addToWaitList(Request $request)
    {
        $request->validate(['email' => 'required|email|max:255']);
        $status = Waitlist::updateOrCreate(['email' => $request->email, 'page' => $request->page], ['email' => $request->email, 'page' => $request->page]);
        if ($status) {
            return collect([
                'status' => true,
                'message' => 'Added to wait list',
            ]);
        }

        return collect([
            'status' => false,
            'message' => 'Something went wrong. Please try again later.',
        ]);
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth::id())->latest()->get()->toArray();
        $now = Carbon::now();
        foreach ($notifications as &$notification) {
            $notification['created_at_formatted'] = Carbon::make($notification['created_at'])->diffForHumans($now);
        }
        $inProgressBatches = Import::importBatches();
        $notifications = array_merge($notifications, $inProgressBatches);

        return response()->json([
            'status' => true,
            'notifications' => $notifications,
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::where('id', Auth::id())->update(['password'=> Hash::make($request->password)]);

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully',
        ], 200);
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', Password::defaults()],
        ]);

        User::where('id', Auth::id())->update(['password'=> Hash::make($request->password)]);

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully',
        ], 200);
    }

    public function uploadTempFile(Request $request)
    {
        $url = null;
        if ($request->image_url) {
            $url = self::uploadFile($request->image_url, 'tmp/');
        }
        return response()->json([
            'url' => $url,
        ], 200);
    }
}
