<?php
namespace App\Domain\Channels\Email;

interface EmailInbox
{
    public function getLastEmail(string $username): ?string;
}