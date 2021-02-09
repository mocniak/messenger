<?php
namespace App\Domain\Channels\Email;

interface EmailSender
{
    public function send(string $emailAddress, string $messageContent): void;
}