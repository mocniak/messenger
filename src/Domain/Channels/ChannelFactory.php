<?php
namespace App\Domain\Channels;

use App\Domain\Channel;
use App\Domain\Channels\Email\EmailChannel;
use App\Domain\Channels\Sms\SmsChannel;

class ChannelFactory
{
    private SmsChannel $smsChannel;
    private EmailChannel $emailChannel;

    public function __construct(SmsChannel $smsChannel, EmailChannel $emailChannel)
    {
        $this->smsChannel = $smsChannel;
        $this->emailChannel = $emailChannel;
    }

    public function build(string $channelName): Channel
    {
        if ($channelName === ActiveChannels::CHANNEL_SMS) {
            return $this->smsChannel;
        }
        if ($channelName === ActiveChannels::CHANNEL_EMAIL) {
            return $this->emailChannel;
        }
        throw new \RuntimeException('No channel with a name "'. $channelName.'"' );
    }
}