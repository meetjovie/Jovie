<?php

namespace App\Http\Controllers;

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
