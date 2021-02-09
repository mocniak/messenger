<?php
namespace App\Domain;

interface EmailInbox
{
    public function getLastEmail(string $username): ?string;
}