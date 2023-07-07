<?php

namespace App\Http\Controllers;

use App\Traits\TwilioTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;

class TwillioController extends Controller
{
    use TwilioTrait;

    public function getOtp(Request $request)
    {
        $request->validate([
            'phone' => [
                'required',
                Rule::unique('users', 'phone')->where(function ($query) use ($request) {
                    return $query->where('country_code', $request->country_code)
                        ->where('id', '<>', $request->user()->id);
                }),
            ],
            'country_code' => 'required',
        ]);
        $number = $request->country_code . $request->phone;
        $verification = $this->generateOtp($number);
        return response([
            "service_sid" => $verification->serviceSid,
            "verification_sid" => $verification->sid,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => [
                'required',
                Rule::unique('users', 'phone')->where(function ($query) use ($request) {
                    return $query->where('country_code', $request->country_code)
                        ->where('id', '<>', $request->user()->id);
                }),
            ],
            'country_code' => 'required',
            'code' => 'required|digits:6',
            'service' => 'required',
        ]);
        $number = $request->country_code . $request->phone;
        $verification = $this->verifyTwilioOtp($request->service['service_sid'], $number, $request->code);
        if ($verification->status == 'approved') {
            $request->user()->phone = $request->phone;
            $request->user()->country_code = $request->country_code;
            $request->user()->save();
        }
        return response([
            "service_sid" => $verification->serviceSid,
            "sid" => $verification->sid,
            "status" => $verification->status,
        ]);
    }
}
