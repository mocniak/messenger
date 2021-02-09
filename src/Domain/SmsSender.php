<?php
namespace App\Domain;

interface SmsSender
{
    public function send(PhoneNumber $phoneNumber, string $messageContent): void;
}