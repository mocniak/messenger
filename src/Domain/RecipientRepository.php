<?php
namespace App\Domain;

interface RecipientRepository
{
    public function save(Recipient $recipient): void;

    public function getByUsername(string $username): Recipient;
}