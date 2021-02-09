<?php
namespace App\Infrastructure;

use App\Domain\Channels\Email\EmailInbox;

class InMemoryEmailInbox implements EmailInbox
{
    private array $emails;

    public function __construct()
    {
        $this->emails = [];
    }

    public function getLastEmail(string $emailAddress): ?string
    {
        return isset($this->emails[$emailAddress]) ? end($this->emails[$emailAddress]) : null;
    }

    public function save(string $emailAddress, string $messageContent)
    {
        $this->emails[$emailAddress][] = $messageContent;
    }
}