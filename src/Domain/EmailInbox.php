<?php
namespace App\Domain;

interface EmailInbox
{
    public function getLastEmail($username): string;
}