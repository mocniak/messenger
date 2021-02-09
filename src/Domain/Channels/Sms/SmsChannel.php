<?php
namespace App\Domain\Channels\Sms;

use App\Domain\Channel;
use App\Domain\Recipient;

class SmsChannel implements Channel
{
    private SmsSender $smsSender;

    public function __construct(SmsSender $smsSender)
    {
        $this->smsSender = $smsSender;
    }

    public function notify(Recipient $recipient, string $messageContent)
    {
        $this->smsSender->send($recipient->smsNumber(), $messageContent);
    }

    public function canSendToRecipient(Recipient $recipient): bool
    {
        return $recipient->smsNumber() !== null;
    }
}