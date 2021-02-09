<?php
namespace App\Infrastructure;

use App\Domain\PhoneNumber;
use App\Domain\SmsInbox;

class InMemorySmsInbox implements SmsInbox
{
    private $smses;

    public function getLastSms(PhoneNumber $phoneNumber): ?string
    {
        return isset($this->smses[$phoneNumber->number()]) ? end($this->smses[$phoneNumber->number()]) : null;
    }

    public function save(PhoneNumber $phoneNumber, string $messageContent)
    {
        $this->smses[$phoneNumber->number()][] = $messageContent;
    }
}