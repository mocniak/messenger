<?php
namespace App\Infrastructure;

use App\Domain\PhoneNumber;
use App\Domain\SmsSender;

class SmsSenderStub implements SmsSender
{
    private InMemorySmsInbox $smsInbox;

    public function __construct(InMemorySmsInbox $smsInbox)
    {
        $this->smsInbox = $smsInbox;
    }

    public function send(PhoneNumber $phoneNumber, string $messageContent): void
    {
        $this->smsInbox->save($phoneNumber, $messageContent);
    }
}