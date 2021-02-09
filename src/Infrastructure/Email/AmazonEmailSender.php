<?php
namespace App\Infrastructure\Email;

use App\Domain\Channels\Email\EmailSender;

class AmazonEmailSender implements EmailSender
{
    public function send(string $emailAddress, string $messageContent): void
    {
        // TODO: Implement send() method.
    }
}