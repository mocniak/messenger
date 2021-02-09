<?php
namespace App\Infrastructure;

use App\Domain\PhoneNumber;
use App\Domain\SmsInbox;

class InMemorySmsInbox implements SmsInbox
{
    private $smses;

    public function getLastSms(PhoneNumber $phoneNumber): string
    {
        return end($this->smses[$phoneNumber->number()]);
    }

    public function save(PhoneNumber $phoneNumber, string $messageContent)
    {
        $this->smses[$phoneNumber->number()][] = $messageContent;
    }
}