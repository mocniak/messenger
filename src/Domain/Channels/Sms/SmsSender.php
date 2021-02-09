<?php
namespace App\Domain\Channels\Sms;

use App\Domain\PhoneNumber;

interface SmsSender
{
    public function send(PhoneNumber $phoneNumber, string $messageContent): void;
}