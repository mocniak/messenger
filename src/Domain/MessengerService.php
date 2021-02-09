<?php
namespace App\Domain;

use App\Domain\Channels\ActiveChannels;
use App\Domain\Channels\ChannelProvider;
use App\Domain\Channels\Email\EmailSender;
use App\Domain\Channels\Sms\SmsSender;

class MessengerService
{
    private RecipientRepository $recipientRepository;
    private EmailSender $emailSender;
    private SmsSender $smsSender;
    private ActiveChannels $activeChannels;
    private ChannelProvider $channelProvider;

    public function __construct(
        RecipientRepository $recipientRepository,
        EmailSender $emailSender,
        SmsSender $smsSender,
        ActiveChannels $activeChannels,
        ChannelProvider $channelProvider
    )
    {
        $this->recipientRepository = $recipientRepository;
        $this->emailSender = $emailSender;
        $this->smsSender = $smsSender;
        $this->activeChannels = $activeChannels;
        $this->channelProvider = $channelProvider;
    }

    public function notify(string $username, string $messageContent): void
    {
        $recipient = $this->recipientRepository->getByUsername($username);
        $channels = $this->channelProvider->getForRecipient($recipient);

        foreach ($channels as $channel) {
            $channel->notify($recipient, $messageContent);
        }
    }
}