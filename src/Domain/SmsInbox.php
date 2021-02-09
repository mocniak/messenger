<?php
namespace App\Domain;

interface SmsInbox
{
    public function getLastSms(PhoneNumber $smsNumber): ?string;
}