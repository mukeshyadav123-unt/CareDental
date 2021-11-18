<?php

namespace App\Actions;

use Exception;
use Lorisleiva\Actions\Concerns\AsObject;
use Twilio\Rest\Client;

class SendSms
{
    use AsObject;

    public function handle(string $receiverNumber, string $message)
    {
        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
                $receiverNumber,
                [
                    'from' => $twilio_number,
                    'body' => $message,
                ]
            );

            dd('SMS Sent Successfully.');
        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }
}
