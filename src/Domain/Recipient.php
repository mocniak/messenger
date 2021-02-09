<?php
namespace App\Domain;

class Recipient
{
    private string $username;
    private ?string $email;
    private ?PhoneNumber $smsNumber;

    public function __construct(string $username)
    {
        $this->username = $username;
        $this->email = null;
        $this->smsNumber = null;
    }

    public function addEmail(string $email)
    {
        $this->email = $email;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function addSmsNumber(PhoneNumber $number)
    {
        $this->smsNumber = $number;
    }

    public function smsNumber(): ?PhoneNumber
    {
        return $this->smsNumber;
    }
}
