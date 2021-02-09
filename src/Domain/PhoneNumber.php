<?php
namespace App\Domain;

class PhoneNumber
{
    private string $number;

    public function __construct(string $phoneNumber)
    {
        //validate here
        $this->number = $phoneNumber;
    }

    public function number(): string
    {
        return $this->number;
    }
}