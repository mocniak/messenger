<?php
namespace App\Infrastructure;

use App\Domain\Channels\Email\EmailSender;

class EmailSenderStub implements EmailSender
{
    private InMemoryEmailInbox $emailInbox;

    public function __construct(InMemoryEmailInbox $emailInbox)
    {
        $this->emailInbox = $emailInbox;
    }

    public function send(string $emailAddress, string $messageContent): void
    {
        $this->emailInbox->save($emailAddress, $messageContent);
    }
}