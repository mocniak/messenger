<?php
namespace App\Infrastructure;

use App\Domain\Channels\Sms\SmsSender;
use App\Domain\PhoneNumber;

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