<?php
namespace App\Infrastructure\Sms;

use App\Domain\Channels\Sms\SmsSender;
use App\Domain\PhoneNumber;
use Twilio\Rest\Client;

class TwilioSmsSender implements SmsSender
{
    private string $twilioAccountId;
    private string $twilioAuthToken;
    private string $twilioPhoneNumber;

    public function __construct(string $twilioAccountId, string $twilioAuthToken, string $twilioPhoneNumber)
    {
        $this->twilioAccountId = $twilioAccountId;
        $this->twilioAuthToken = $twilioAuthToken;
        $this->twilioPhoneNumber = $twilioPhoneNumber;
    }

    public function send(PhoneNumber $phoneNumber, string $messageContent): void
    {
        $client = new Client($this->twilioAccountId, $this->twilioAuthToken);

        $client->messages->create(
            $phoneNumber->number(),
            [
                'from' => $this->twilioPhoneNumber,
                'body' => $messageContent
            ]
        );
    }
}