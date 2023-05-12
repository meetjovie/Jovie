<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

trait TwilioTrait
{
    public function initClient()
    {
        $sid = config('app.twilio_sid');
        $token = config('app.twilio_token');
        return new Client($sid, $token);
    }

    public function createService()
    {
        $client = $this->initClient();
        return $client->verify->v2->services->create("Otp", ["codeLength" => 6]);
    }

    public function generateOtp($number)
    {
        $client = $this->initClient();
        $service = $this->createService();
        return $client->verify->v2->services($service->sid)
            ->verifications
            ->create($number, "sms");
    }

    public function verifyTwilioOtp($service_sid, $number, $code)
    {
        $client = $this->initClient();
        return $client->verify->v2->services($service_sid)
            ->verificationChecks
            ->create([
                    "to" => $number,
                    "code" => $code,
                ]
            );
    }

    public function sendSmsMessage($to, $body, $from)
    {
        $client = $this->initClient();
        $client->messages
            ->create($to, ["body" => $body, "from" => $from]
            );
    }

    public function fetchLastContactDetailMessage($from, $to)
    {
        $client = $this->initClient();
        return $client->messages
            ->read([
                'from' => $from,
                'to' => $to,
                'order' => 'desc',
            ],2)[0]->body;
    }
}
