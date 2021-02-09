<?php
namespace App\Domain\Channels;

use App\Domain\Channel;
use App\Domain\Recipient;

class ChannelProvider
{
    private ActiveChannels $activeChannels;

    public function __construct(ActiveChannels $activeChannels)
    {
        $this->activeChannels = $activeChannels;
    }

    /**
     * @param Recipient $recipient
     * @return Channel[]
     */
    public function getForRecipient(Recipient $recipient): array
    {
        $recipientChannels = [];
        foreach ($this->activeChannels->getEnabled() as $activeChannel) {
            if ($activeChannel->canSendToRecipient($recipient)){
                $recipientChannels[] = $activeChannel;
            }
        }
        return $recipientChannels;
    }
}