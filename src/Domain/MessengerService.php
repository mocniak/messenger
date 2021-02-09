<?php
namespace App\Domain;

class MessengerService
{
    private RecipientRepository $recipientRepository;
    private EmailSender $emailSender;
    /**
     * @var SmsSender
     */
    private SmsSender $smsSender;

    public function __construct(RecipientRepository $recipientRepository, EmailSender $emailSender, SmsSender $smsSender)
{
    $this->recipientRepository = $recipientRepository;
    $this->emailSender = $emailSender;
    $this->smsSender = $smsSender;
}

    public function notify(string $username, string $messageContent): void
    {
        $recipient = $this->recipientRepository->getByUsername($username);
        if ($recipient->email() !== null) {
            $this->emailSender->send($recipient->email(), $messageContent);
        }
        if ($recipient->smsNumber() !== null) {
            $this->smsSender->send($recipient->smsNumber(), $messageContent);
        }
    }
}