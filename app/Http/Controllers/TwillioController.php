<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Traits\TwilioTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;

class TwillioController extends Controller
{
    use TwilioTrait;

    public function getOtp(Request $request)
    {
        $user_id = null;
        if ($request->number) {
            $user = User::query()->where('phone', $request->number)->first('id');
            $user_id = $user?->id;
        }
        $request->validate([
            'number' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->filled('login') && !User::where('phone', $value)->exists()) {
                        $fail('Invalid phone number.');
                    }
                },
                'unique:users,phone,' . ($user_id ?? ($request->user() ? $request->user()->id : null))
            ],
        ]);
        $verification = $this->generateOtp($request->number);
        return response([
            "service_sid" => $verification->serviceSid,
            "verification_sid" => $verification->sid,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $user_id = null;
        $user = null;
        if ($request->number) {
            $user = User::query()->where('phone', $request->number)->first('id');
            $user_id = $user?->id;
        }
        $request->validate([
            'number' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->filled('login') && !User::where('phone', $value)->exists()) {
                        $fail('Invalid phone number.');
                    }
                },
                'unique:users,phone,' . ($user_id ?? ($request->user() ? $request->user()->id : null))
            ],
        ]);
        $verification = $this->verifyTwilioOtp($request->service['service_sid'], $request->number, $request->code);
        if ($verification->status == 'approved' && !$request->filled('login')) {
            if ($user) {
                $user->phone = $request->number;
                $user->save();
            } else {
                $request->user()->phone = $request->number;
                $request->user()->save();
            }
        }
        return response([
            "service_sid" => $verification->serviceSid,
            "sid" => $verification->sid,
            "status" => $verification->status,
        ]);
    }

    public function receiveSms(Request $request, UserService $userService)
    {
        $request = $request->all();
        $response = new MessagingResponse();
        $body = $request['Body'];

        if (strtolower($body) == 'yes') {
            $lastMessage = $this->fetchLastContactDetailMessage($request['From'], $request['To']);
            $user = $userService->fetchUserWithPhoneNumber($request['From']);
            $name = explode(' ', $lastMessage);
            $firstName = $name[0];
            $lastName = $name[1] ?? null;
            if (strtolower($lastMessage) == 'yes' || strtolower($lastMessage) == 'no') {
            } else {
                if (!$user) {
                    $user = $userService->registerNewUser($request['From'], $firstName, $lastName);
                }
                $userService->importContactFromUser($user, $firstName, $lastName);
            }
        } else {
            $body = "Do you want to create contact with the name" . '"' . $request['Body'] . '" ?';
            $response->message($body);
            return $response;
        }
    }

    public function handleFailedSms(Request $request)
    {
        Log::info($request);
    }
}
