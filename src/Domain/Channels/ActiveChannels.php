<?php
namespace App\Domain\Channels;

use App\Domain\Channel;

class ActiveChannels
{
    public const CHANNEL_EMAIL = 'email';
    public const CHANNEL_SMS = 'sms';
    public const ALL_CHANNELS = [self::CHANNEL_EMAIL, self::CHANNEL_SMS];
    /** @var bool[] */
    private array $channels;
    private ChannelFactory $factory;

    public function __construct(ChannelFactory $factory)
    {
        $this->factory = $factory;
        $this->channels = [
            self::CHANNEL_SMS => true,
            self::CHANNEL_EMAIL => true,
        ];
    }

    public function disable(string $channelName)
    {
        $this->channels[$channelName] = false;
    }

    public function isEnabled(string $channelName): bool
    {
        return $this->channels[$channelName];
    }

    /**
     * @return Channel[]
     */
    public function getEnabled(): array
    {
        $enabledChannels = [];
        foreach ($this->channels as $channelName => $isActive) {
            if ($isActive) {
                $enabledChannels[] = $this->factory->build($channelName);
            }
        }
        return $enabledChannels;
    }
}