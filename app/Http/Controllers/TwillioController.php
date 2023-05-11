<?php

namespace App\Http\Controllers;

use App\Traits\TwilioTrait;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;

class TwillioController extends Controller
{
    use TwilioTrait;

    public function getOtp(Request $request)
    {
        $request->validate([
            'number' => 'required|unique:users,phone'
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
            'number' => 'required|unique:users,phone',
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
}
