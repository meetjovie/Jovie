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
        $request->validate([
            'number' => 'required|unique:users,phone,' . $request->user()->id,
        ]);
        $verification = $this->generateOtp($request->number);
        return response([
            "service_sid" => $verification->serviceSid,
            "verification_sid" => $verification->sid,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'number' => 'required|unique:users,phone,' . $request->user()->id,
            'code' => 'required|digits:6',
            'service' => 'required',
        ]);
        $verification = $this->verifyTwilioOtp($request->service['service_sid'], $request->number, $request->code);
        if ($verification->status == 'approved') {
            $request->user()->phone = $request->number;
            $request->user()->save();
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
//            if (strtolower($lastMessage) == 'yes' || strtolower($lastMessage) == 'no') {
//
//            } else {
                if (!$user) {
                    $user = $userService->registerNewUser($request['From'], $firstName, $lastName);
                }
                Auth::loginUsingId($user->id);
                $userService->importContactFromUser($user, $firstName, $lastName);
//            }

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
