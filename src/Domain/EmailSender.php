<?php
namespace App\Domain;

interface EmailSender
{
    public function send(string $emailAddress, string $messageContent): void;
}