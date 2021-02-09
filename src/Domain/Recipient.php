<?php
namespace App\Domain;

class Recipient
{
    private string $username;
    /** @var string[] */
    private array $emails;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function addEmail(string $string)
    {
        $this->emails[] = $string;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function email(): string
    {
        return reset($this->emails);
    }
}
