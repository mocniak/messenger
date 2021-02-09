<?php
namespace App\Domain\Channels\Email;

use App\Domain\Channel;
use App\Domain\Recipient;

class EmailChannel implements Channel
{
    private EmailSender $emailSender;

    public function __construct(EmailSender $emailSender)
    {
        $this->emailSender = $emailSender;
    }

    public function notify(Recipient $recipient, string $messageContent): void
    {
        if ($recipient->email() !== null) {
                $this->emailSender->send($recipient->email(), $messageContent);
        }
    }

    public function canSendToRecipient(Recipient $recipient): bool
    {
        return $recipient->email() !== null;
    }
}