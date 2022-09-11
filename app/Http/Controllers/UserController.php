<?php

namespace App\Http\Controllers;

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
                'show_instagram',
                'instagram_handler',
                'tiktok_handler',
                'show_tiktok',
                'show_youtube',
                'youtube_handler'
            )->first();
        if ($user) {
            $user->profile_pic_url = $this->getProfilePic($user);
            $user->name = $user->first_name ? ($user->first_name.' '.$user->last_name) : $user->username;
            $user = json_decode(json_encode($user));
            $user->creator_profile = [
                'instagram_handler' => $user->instagram_handler,
                'tiktok_handler' => $user->tiktok_handler,
                'youtube_handler' => $user->youtube_handler,
            ];
            return response([
                'status' => true,
                'data' => User::currentLoggedInUser(),
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
                'instagram_meta->profile_pic_url as instagram_profile_pic',
                'instagram_meta->external_link as external_link as call_to_action'
            )->first();

        if ($user) {
            $user->name = $user->first_name ? ($user->first_name.' '.$user->last_name) : ($user->full_name ?? $user->username);
            $user->profile_pic_url = $this->getProfilePic($user);
            $user->call_to_action_text = 'Follow Instagram';
            $user->call_to_action = $this->getCta($user);

            $user = json_decode(json_encode($user));
            $user->creator_profile = [
                'instagram_handler' => $user->instagram_handler,
                'tiktok_handler' => $user->tiktok_handler,
                'youtube_handler' => $user->youtube_handler,
            ];

            // when user is from creator default each link to show
            foreach (Creator::NETWORKS as $network) {
                $user['show_'.$network] = true;
            }

            return response([
                'status' => true,
                'data' => User::currentLoggedInUser(),
                'networks' => Creator::NETWORKS,
            ], 200);
        }

        return response([
            'status' => false,
            'message' => 'Creator not found.',
        ]);
    }

    public function getCta($user)
    {
        if ($user->call_to_action) {
            return $user->call_to_action;
        }

        $cta = null;
        foreach (Creator::NETWORKS as $network) {
            if ($cta = $user[$network.'_handler']) {
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
            'first_name' => 'sometimes|required|max:255',
            'last_name' => 'sometimes|required|max:255',
            'profile_pic_url' => 'sometimes|nullable|string',
            'username' => 'sometimes|nullable|string',
            'facebook_handler' => 'sometimes|nullable|string',
            'twitter_handler' => 'sometimes|nullable|string',
            'instagram_handler' => 'sometimes|nullable|string',
            'youtube_handler' => 'sometimes|nullable|string',
            'tiktok_handler' => 'sometimes|nullable|string',
            'twitch_handler' => 'sometimes|nullable|string',
        ]);
        $path = null;
        if (Auth::user()->getRawOriginal('profile_pic_url')) {
            $filename = explode(User::UPLOAD_PATH, Auth::user()->profile_pic_url)[1];
            $path = User::UPLOAD_PATH.$filename;
        }
        if ($request->profile_pic_url) {
            Storage::disk('s3')->copy(
                ('tmp/'.$request->input('profile_pic_url')),
                (User::UPLOAD_PATH.$request->input('profile_pic_url'))
            );
            $data['profile_pic_url'] = Storage::disk('s3')->url((User::UPLOAD_PATH.$request->input('profile_pic_url')));
        }
        $user = User::where('id', Auth::user()->id)->update($data);
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
        $inProgressBatches = $this->importBatches();
        $notifications = array_merge($notifications, $inProgressBatches);

        return response()->json([
            'status' => true,
            'notifications' => $notifications,
        ], 200);
    }

    public function importBatches()
    {
        $lists = UserList::getLists(Auth::id());
        $userListIds = $lists->pluck('id')->toArray();
        $batches = DB::table('job_batches')
            ->join('user_lists', 'user_lists.id', '=', 'job_batches.user_list_id')
            ->select('job_batches.*', 'user_lists.name')
            ->where('finished_at', '=', null)
            ->whereIn('user_list_id', $userListIds)
            ->latest('job_batches.created_at')
            ->get();
        $now = Carbon::now();
        foreach ($batches as &$batch) {
            $batch->is_batch = true;
            $batch->error_message = Import::getBatchErrorMessage($batch);
            $batch->progress = Import::getProgress($batch);
            $batch->successful = Import::getSuccessfulCount($batch);
            $batch->created_at_formatted = Carbon::createFromTimestamp($batch->created_at)->diffForHumans($now);
            unset($batch->options);
        }

        return $batches->toArray();
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
}
