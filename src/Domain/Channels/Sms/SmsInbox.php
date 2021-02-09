<?php
namespace App\Domain\Channels\Sms;

use App\Domain\PhoneNumber;

interface SmsInbox
{
    public function getLastSms(PhoneNumber $smsNumber): ?string;
}