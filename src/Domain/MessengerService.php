<?php
namespace App\Domain;

class MessengerService
{
    private RecipientRepository $recipientRepository;
    private EmailSender $emailSender;

    public function __construct(RecipientRepository $recipientRepository, EmailSender $emailSender)
{
    $this->recipientRepository = $recipientRepository;
    $this->emailSender = $emailSender;
}

    public function notify(string $username, string $messageContent): void
    {
        $recipient = $this->recipientRepository->getByUsername($username);
        $this->emailSender->send($recipient->email(), $messageContent);
    }
}