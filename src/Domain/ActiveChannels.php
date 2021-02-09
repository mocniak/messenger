<?php
namespace App\Domain;

class ActiveChannels
{
    public const CHANNEL_EMAIL = 'email';
    public const CHANNEL_SMS = 'sms';
    public const ALL_CHANNELS = [self::CHANNEL_EMAIL, self::CHANNEL_SMS];
    /** @var bool[]  */
    private array $channels;

    public function __construct()
    {
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

}