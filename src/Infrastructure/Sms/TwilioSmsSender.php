<?php
namespace App\Infrastructure\Sms;

use App\Domain\Channels\Sms\SmsSender;
use App\Domain\PhoneNumber;

class TwilioSmsSender implements SmsSender
{
    public function send(PhoneNumber $phoneNumber, string $messageContent): void
    {
        // TODO: Implement send() method.
    }
}