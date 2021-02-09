<?php
namespace App\Domain;

class MessengerService
{
    private RecipientRepository $recipientRepository;
    private EmailSender $emailSender;
    private SmsSender $smsSender;
    private ActiveChannels $activeChannels;

    public function __construct(
        RecipientRepository $recipientRepository,
        EmailSender $emailSender,
        SmsSender $smsSender,
        ActiveChannels $activeChannels
    )
    {
        $this->recipientRepository = $recipientRepository;
        $this->emailSender = $emailSender;
        $this->smsSender = $smsSender;
        $this->activeChannels = $activeChannels;
    }

    public function notify(string $username, string $messageContent): void
    {
        $recipient = $this->recipientRepository->getByUsername($username);
        if ($recipient->email() !== null) {
            if ($this->activeChannels->isEnabled(ActiveChannels::CHANNEL_EMAIL)) {
                $this->emailSender->send($recipient->email(), $messageContent);
            }
        }
        if ($recipient->smsNumber() !== null) {
            if ($this->activeChannels->isEnabled(ActiveChannels::CHANNEL_SMS)) {
                $this->smsSender->send($recipient->smsNumber(), $messageContent);
            }
        }
    }
}