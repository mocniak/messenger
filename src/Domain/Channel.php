<?php
namespace App\Domain;

interface Channel
{
    public function notify(Recipient $recipient, string $messageContent);

    public function canSendToRecipient(Recipient $recipient): bool;
}