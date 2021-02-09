<?php
namespace App\Infrastructure;

use App\Domain\EmailInbox;

class InMemoryEmailInbox implements EmailInbox
{
    private $emails;

    public function getLastEmail($emailAddress): string
    {
        return end($this->emails[$emailAddress]);
    }

    public function save(string $emailAddress, string $messageContent)
    {
        $this->emails[$emailAddress][] = $messageContent;
    }
}